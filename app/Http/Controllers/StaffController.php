<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\SubBatch;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class StaffController extends Controller
{
    function addStaff(){
        return view('staff.add_staff');
    }
    function viewStaff(){
        $teachers = User::where('role', 'Teacher')->with(['batches','subBatches'])->get();
        return view('staff.view_staff', compact('teachers'));
       
    }
//     function viewStaff()
// {
//     $teachers = User::where('role', 'Teacher')
//         ->with(['batches', 'subBatches'])
//         ->get()
//         ->map(function ($teacher) {
//             $batchUser = DB::table('batch_user')->where('user_id', $teacher->id)->first();

//             $teacher->batchIds = $batchUser ? json_decode($batchUser->batch_ids, true) : [];
//             $teacher->subBatchIds = $batchUser ? json_decode($batchUser->sub_batches_ids, true) : [];

//             // Fetch batch names
//             $teacher->batchNames = Batch::whereIn('id', $teacher->batchIds)->pluck('name');
//             $teacher->subBatchNames = SubBatch::whereIn('id', $teacher->subBatchIds)->pluck('name');

//             return $teacher;
//         });

//     return view('staff.view_staff', compact('teachers'));
// }

    function addStaffPost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => 'Teacher', // Predefined role
        ]);
        return redirect()->route('add_staff')->with('success', 'Staff added successfully!');
    }

    function editStaff($id)
{   
            // Fetch only teachers
            $teacher = User::where('role', 'Teacher')->with('batches')->findOrFail($id);

            // Fetch batch and sub-batch data
            $batchUser = DB::table('batch_user')->where('user_id', $id)->first();
            
            // Check if batch_ids and sub_batches_ids are JSON and decode them into arrays
            $batchIds = $batchUser && isset($batchUser->batch_ids) ? json_decode($batchUser->batch_ids, true) : [];
            $subBatchIds = $batchUser && isset($batchUser->sub_batches_ids) ? json_decode($batchUser->sub_batches_ids, true) : [];

            // Ensure that the decoded values are arrays, fallback to empty array if not
            if (!is_array($batchIds)) {
                $batchIds = [];
            }
            if (!is_array($subBatchIds)) {
                $subBatchIds = [];
            }

            // Fetch available batches and sub-batches
            $batches = Batch::where('flag', 1)->get();
            $subBatches = SubBatch::whereIn('batch_id', $batchIds)->get();
            

    // Debugging: Check the subBatches data
    return view('staff.edit_staff', compact('teacher', 'batches', 'subBatches', 'batchIds', 'subBatchIds'));
}

    

        function updateStaff(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'batches' => 'array|required',
                'sub_batches' => 'array|nullable',
            ]);

            $teacher = User::where('role', 'Teacher')->findOrFail($id);
            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->save();

            $teacher->batches()->sync($request->batches, ['role' => 'Teacher']);

            // Convert batches and sub-batches to JSON format
            $batchIds = $request->batches ?? []; // Array of batch IDs
            $subBatchIds = $request->sub_batches ?? []; // Array of sub-batch IDs, or empty array

             // Upsert the data in the batch_user table
            DB::table('batch_user')->updateOrInsert(
            ['user_id' => $teacher->id],
            [
            'batch_ids' => json_encode($batchIds),// Store batch IDs as JSON
            'sub_batches_ids' => json_encode($subBatchIds),
            'role' => 'Teacher',
            'updated_at' => now(),
        ]
    );

        return redirect()->route('view_staff')->with('success', 'Staff updated successfully!');
    }

    function deleteStaff($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect()->route('view_staff')->with('success', 'Staff deleted successfully!');
    }

}
