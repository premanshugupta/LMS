<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    function addBatch(){
        return view('batch.add_batch');
        }

        function addBatchPost(Request $request){
            $request->validate([
                'name'=> 'required',
            ]);
            Batch::create([
                'name' => $request->name,
                'flag' => 1, // Default to active
            ]);

            return redirect()->route('view_Batch')->with('success', 'Batch created successfully!');
        }

        // public function addBatchPost(Request $request)
        // {
        //     // Validate input
        //     $request->validate([
        //         'name' => 'required|string|max:255|unique:batches',
        //     ]);
    
        //     // Create the batch
        //     Batch::create([
        //         'name' => $request->name,
        //         'flag' => 1, // Default to active
        //     ]);
    
        //     return redirect()->route('view_batches')->with('success', 'Batch created successfully!');
        // }

    function viewBatch(){
        $batches = Batch::all();
        return view('batch.view_batch', compact('batches'));
        }


        function toggleBatchStatus($id)
        {
            $batch = Batch::findOrFail($id);
    
            // Toggle the flag
            $batch->flag = !$batch->flag;
            $batch->save();
    
            $status = $batch->flag ? 'activated' : 'deactivated';
            return redirect()->route('view_Batch')->with('success', "Batch $status successfully!");
        }

}
