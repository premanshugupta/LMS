<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\SubBatch;
use App\Models\User;
use Illuminate\Http\Request;

class SubController extends Controller
{
    function addSubBatch(){
        $batches = Batch::where('flag', 1)->get();
        return view('sub.add_subBatch',compact('batches'));
    }

    function viewSubBatch(){
        // $subBatches = Batch::where('flag', 1)->with('subBatches')->get();
        $subBatches = SubBatch::whereHas('batch', function ($query) {
            $query->where('flag', 1); // Only include active batches
        })->with('batch')->get();
        return view('sub.view_subBatch', compact('subBatches'));
    }
     function addSubBatchPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'batch_id' => 'required|exists:batches,id',
        ]);

        $batch = Batch::findOrFail($request->batch_id);

        // Add sub-batch
        SubBatch::create([
            'name' => $request->name,
            'flag' => $batch->flag, // Match the parent batch flag
            'batch_id' => $batch->id,
        ]);

        return redirect()->route('view_SubBatch')->with('success', 'Sub-batch added successfully!');
    }
    // public function toggleBatchStatus($id)
    // {
    //     $batch = Batch::findOrFail($id);

    //     // Toggle batch flag
    //     $batch->flag = !$batch->flag;
    //     $batch->save();

    //     // Update all associated sub-batches
    //     foreach ($batch->subBatches as $subBatch) {
    //         $subBatch->flag = $batch->flag;
    //         $subBatch->save();
    //     }

    //     return redirect()->route('view_SubBatch')->with('success', 'Batch and its sub-batches status updated!');
    // }


    public function toggleSubBatchStatus($id){
         // Find the sub-batch by ID
    $subBatch = SubBatch::findOrFail($id);
    
    // Toggle the flag
    $subBatch->flag = !$subBatch->flag;
    
    // Save the updated sub-batch
    $subBatch->save();
    // Redirect back with a success message
    return redirect()->back()->with('success', 'Sub-batch status updated successfully!');
    }

    public function getSubBatches(Request $request)
{
    $request->validate([
        'batches' => 'required|array',
        'batches.*' => 'exists:batches,id',
    ]);

    $subBatches = SubBatch::whereIn('batch_id', $request->batches)
                          ->where('flag', 1) // Only active sub-batches
                          ->get();

    return response()->json(['subBatches' => $subBatches]);
}

public function updateStaff(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'batches' => 'required|array',
        'batches.*' => 'exists:batches,id',
        'sub_batches' => 'nullable|array',
        'sub_batches.*' => 'exists:sub_batches,id',
    ]);

    $staff = User::findOrFail($id);

    // Update staff details
    $staff->update(['name' => $request->name]);

    // Sync batches and sub-batches
    $staff->batches()->sync($request->batches);
    $staff->subBatches()->sync($request->sub_batches ?? []);

    return redirect()->route('view_staff')->with('success', 'Staff updated successfully!');
}

public function editStaff($id)
{
    $teacher = User::with('batches')->where('role', 'teacher')->findOrFail($id);
    $batches = Batch::where('flag', 1)->get(); // Only active batches
    $subBatches = SubBatch::whereIn('batch_id', $teacher->batches->pluck('id')->toArray())->get(); // Sub-batches for selected batches

    return view('staff.edit', compact('teacher', 'batches', 'subBatches'));
}

}
