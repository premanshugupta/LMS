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
      // Fetch all teachers
      $teachers = User::where('role', 'Teacher')->get();

      // Fetch associated batch and sub-batch names directly
      $teachersData = $teachers->map(function ($teacher) {
          // Fetch batch IDs from batch_user table
          $batchIds = DB::table('batch_user')
              ->where('user_id', $teacher->id)
              ->value('batch_ids');
          
          // Decode batch IDs JSON or use an empty array
          $batchIdsArray = $batchIds ? json_decode($batchIds, true) : [];
          
          // Fetch sub-batch IDs from batch_user table
          $subBatchIds = DB::table('batch_user')
              ->where('user_id', $teacher->id)
              ->value('sub_batches_ids');
  
          // Decode sub-batch IDs JSON or use an empty array
          $subBatchIdsArray = $subBatchIds ? json_decode($subBatchIds, true) : [];
  
          // Fetch batch names
          $batchNames = DB::table('batches')
              ->whereIn('id', $batchIdsArray)
              ->pluck('name')
              ->toArray();
  
          // Fetch sub-batch names
          $subBatchNames = DB::table('sub_batches')
              ->whereIn('id', $subBatchIdsArray)
              ->pluck('name')
              ->toArray();
  
          return [
              'id' => $teacher->id,
              'name' => $teacher->name,
              'email' => $teacher->email,
              'role' => $teacher->role,
              'batches' => $batchNames, // Names of the batches
              'sub_batches' => $subBatchNames, // Names of the sub-batches
          ];
      });
  

        return view('staff.view_staff', ['teachersData' => $teachersData]);
       
    }

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


public function editStaff($id)
{
    // Fetch the teacher by ID
    $teacher = User::where('role', 'Teacher')->findOrFail($id);

    // Fetch batch and sub-batch data for the teacher
    $batchUser = DB::table('batch_user')->where('user_id', $id)->first();

    // Decode the batch IDs and sub-batch IDs from the JSON columns
    $batchIds = $batchUser && isset($batchUser->batch_ids) ? json_decode($batchUser->batch_ids, true) : [];
    $subBatchIds = $batchUser && isset($batchUser->sub_batches_ids) ? json_decode($batchUser->sub_batches_ids, true) : [];

    // Fetch available batches and sub-batches
    $batches = Batch::where('flag', 1)->get(); // Assuming 'flag' determines active batches
    $subBatches = SubBatch::whereIn('batch_id', $batchIds)->get(); // Fetch sub-batches that belong to the selected batches

    // Pass teacher data, batches, sub-batches, and selected batch and sub-batch IDs to the view
    return view('staff.edit_staff', compact('teacher', 'batches', 'subBatches', 'batchIds', 'subBatchIds'));
}

public function updateStaff(Request $request, $id)
{
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'batch_ids' => 'array|nullable',
        'sub_batches_ids' => 'array|nullable', 
    ]);

    
    $teacher = User::where('role', 'Teacher')->findOrFail($id);
    
    // Update teacher's name and email in the 'users' table
    $teacher->name = $request->name;
    $teacher->email = $request->email;
    $teacher->save();  // Save to the User table

    // Prepare the data as arrays
    $batchIds = $request->batch_ids ?? [];  // Array of batch IDs
    $subBatchIds = $request->sub_batches_ids ?? [];  // Array of sub-batch IDs (nullable)


    DB::table('batch_user')->updateOrInsert(
        ['user_id' => $teacher->id],
        [
            'batch_ids' => json_encode($batchIds),  
            'sub_batches_ids' => json_encode($subBatchIds),  
            'role' => 'Teacher',
            'updated_at' => now(),  // Update the timestamp
        ]
    );

    // Redirect to the staff view page with success message
    return redirect()->route('view_staff')->with('success', 'Staff updated successfully!');
}



    function deleteStaff($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect()->route('view_staff')->with('success', 'Staff deleted successfully!');
    }

    // function assignTask(){
    //     return view('assignment.assign_task');
    // }
    function assignClass(){
        return view('assignment.assign_class');
    }
    function assignLecture(){
        return view('assignment.assign_lecture');
    }

     function assignTaskPost()
{
    $batches = Batch::all(); // All available batches
    $subBatches = SubBatch::all(); // All available sub-batches
    $students = User::where('role', 'Student')->with(['batch', 'subBatch'])->get(); // Students with their assigned batches and sub-batches

    return view('assignment.assign_task', compact('batches', 'subBatches', 'students'));
}

 function storeTask(Request $request)
{
    $request->validate([
        'batch_id' => 'nullable|exists:batches,id',
        'sub_batch_id' => 'nullable|exists:sub_batches,id',
        'selected_students' => 'nullable|array',
        'doc_file' => 'nullable|file|mimes:pdf,doc,docx',
        'link' => 'nullable|url',
    ]);

    // Save the uploaded file
    $filePath = null;
    if ($request->hasFile('doc_file')) {
        $filePath = $request->file('doc_file')->store('tasks', 'public');
    }

    // Save task in the database
    // Task::create([
    //     'batch_id' => $request->batch_id,
    //     'sub_batch_id' => $request->sub_batch_id,
    //     'students' => $request->selected_students ? json_encode($request->selected_students) : null,
    //     'file_path' => $filePath,
    //     'link' => $request->link,
    // ]);

    return redirect()->back()->with('success', 'Task Assigned Successfully!');
}


}

