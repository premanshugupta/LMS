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
        // Fetch active batches and sub-batches
    $activeBatches = Batch::where('flag', 1)->get();
    $activeSubBatches = SubBatch::where('flag', 1)->get();

    // Pass the data to the view
    return view('staff.add_staff', compact('activeBatches', 'activeSubBatches'));
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

public function addStaffPost(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'batches' => 'array|nullable', // Ensure batches are selected
        'sub_batches' => 'array|nullable', // Ensure sub-batches are selected
    ]);

    // Create the teacher (user)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password), // Hash the password
        'role' => 'Teacher', // Predefined role
    ]);

    // Prepare the batch and sub-batch data as arrays
    $batchIds = $request->batches ?? [];
    $subBatchIds = $request->sub_batches ?? [];

    // Store the batch and sub-batch data in the 'batch_user' table
    DB::table('batch_user')->insert([
        'user_id' => $user->id,
        'batch_ids' => json_encode($batchIds),  // Store as JSON array
        'sub_batches_ids' => json_encode($subBatchIds),  // Store as JSON array
        'role' => 'Teacher',
        'created_at' => now(),  // Set the creation timestamp
    ]);

    // Redirect with success message
    return redirect()->route('add_staff')->with('success', 'Staff added successfully!');
}



function editStaff($id)
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

public function getSubBatchesByBatch(Request $request)
{
    $batchIds = explode(',', $request->query('batch_ids', ''));

    if (empty($batchIds)) {
        return response()->json([], 200); // Return empty if no batch IDs are selected
    }

    // Fetch sub-batches for the given batch IDs
    $subBatches = SubBatch::whereIn('batch_id', $batchIds)->get(['id', 'name', 'batch_id']);

    return response()->json($subBatches, 200); // Return sub-batches as JSON
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

    // Validate the condition: If batch_ids is assigned, at least one sub_batches_ids must also be assigned
    if (!empty($request->batch_ids) && empty($request->sub_batches_ids)) {
        return redirect()->back()->withErrors([
            'sub_batches_ids' => 'At least one Sub Batch must be assigned when a batch is assigned.',
        ])->withInput();
    }
    // Find the teacher
    $teacher = User::where('role', 'Teacher')->findOrFail($id);

    // Update teacher's name and email in the 'users' table
    $teacher->name = $request->name;
    $teacher->email = $request->email;
    $teacher->save(); // Save to the User table

    // Prepare the data as arrays
    $batchIds = $request->batch_ids ?? [];
    $subBatchIds = $request->sub_batches_ids ?? [];

    // Fetch existing batch and sub-batch data for the teacher
    $batchUser = DB::table('batch_user')->where('user_id', $teacher->id)->first();
    $existingBatchIds = $batchUser ? json_decode($batchUser->batch_ids, true) : [];
    $existingSubBatchIds = $batchUser ? json_decode($batchUser->sub_batches_ids, true) : [];

    // Check if batch_ids or sub_batches_ids have changed
    $isBatchChanged = $batchIds != $existingBatchIds;
    $isSubBatchChanged = $subBatchIds != $existingSubBatchIds;

    if ($isBatchChanged || $isSubBatchChanged) {
        // Only update or insert if there is a change in batch or sub-batch data
        DB::table('batch_user')->updateOrInsert(
            ['user_id' => $teacher->id],
            [
                'batch_ids' => json_encode($batchIds),
                'sub_batches_ids' => json_encode($subBatchIds),
                'role' => 'Teacher',
                'updated_at' => now(), // Update the timestamp
            ]
        );
    }

    // Redirect to the staff view page with success message
    return redirect()->route('view_staff')->with('success', 'Staff updated successfully!');
}





    function deleteStaff($id)
    {
        $teacher = User::findOrFail($id);
        $teacher->delete();

        return redirect()->route('view_staff')->with('success', 'Staff deleted successfully!');
    }

public function teacherDashboard()
{
    // Get the authenticated user
    $teacher = auth()->user();

    // Ensure the user is a teacher
    if ($teacher->role !== 'Teacher') {
        return redirect()->route('home')->with('error', 'Access denied.');
    }

    // Fetch the batch_user record for the teacher
    $batchUser = DB::table('batch_user')
        ->where('user_id', $teacher->id)
        ->where('role', 'Teacher')
        ->first();

    // Check if the teacher has assigned batches
    if (!$batchUser) {
        return view('teacher.teacher_dashboard', ['assignedBatches' => []]);
    }

    // Decode the batch_ids and sub_batch_ids
    $batchIds = json_decode($batchUser->batch_ids, true);
    $subBatchIds = json_decode($batchUser->sub_batches_ids, true);

    // Fetch the Batch models
    $assignedBatches = Batch::whereIn('id', $batchIds)->get();

    // Attach sub-batches to each batch
    $assignedBatches->each(function ($batch) use ($subBatchIds) {
        $batch->subBatches = SubBatch::where('batch_id', $batch->id)
                                     ->whereIn('id', $subBatchIds)
                                     ->get();
    });

    // Return view with assigned batches and their sub-batches
    return view('teacher.teacher_dashboard', compact('assignedBatches'));
}



}

