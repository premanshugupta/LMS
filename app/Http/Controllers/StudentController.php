<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\SubBatch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class StudentController extends Controller
{
    function addStudent(){
        return view('student.add_student');
    }

    // function viewStudent(Request $request){
    //     $role = $request->role; // Get the role dynamically from the request (e.g., 'Student' or 'Teacher')

    // if (!$role) {
    //     // Default to 'Student' if no role is passed
    //     $role = 'Student';
    // }
    //      // Fetch users based on the selected role
    //     $students = User::where('role', $role)
    //     ->with(['batches' => fn($query) => $query->wherePivot('role', $role), 
    //             'subBatches' => fn($query) => $query->wherePivot('role', $role)])
    //     ->get();
        
    //     // $students = User::where('role', 'Student')->get();
    //     return view('student.view_student', compact('students'));
    // }
    function viewStudent(Request $request){
        // Fetch all teachers
        $students = User::where('role', 'Student')->get();
  
        // Fetch associated batch and sub-batch names directly
        $studentsData = $students->map(function ($student) {
            // Fetch batch IDs from batch_user table
            $batchIds = DB::table('batch_user')
                ->where('user_id', $student->id)
                ->value('batch_ids');
            
            // Decode batch IDs JSON or use an empty array
            $batchIdsArray = $batchIds ? json_decode($batchIds, true) : [];
            
            // Fetch sub-batch IDs from batch_user table
            $subBatchIds = DB::table('batch_user')
                ->where('user_id', $student->id)
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
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'role' => $student->role,
                'batches' => $batchNames, // Names of the batches
                'sub_batches' => $subBatchNames, // Names of the sub-batches
            ];
        });
    
  
          return view('student.view_student', ['studentsData' => $studentsData]);
         
      }

    function addStudentPost(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'role' => 'Student', // Predefined role
        ]);
        return redirect()->route('view_student')->with('success', 'Staff added successfully!');
    }

    public function editStudent($id)
{
    // Fetch the teacher by ID
    $student = User::where('role', 'Student')->findOrFail($id);

    // Fetch batch and sub-batch data for the teacher
    $batchUser = DB::table('batch_user')->where('user_id', $id)->first();

    // Decode the batch IDs and sub-batch IDs from the JSON columns
    $batchIds = $batchUser && isset($batchUser->batch_ids) ? json_decode($batchUser->batch_ids, true) : [];
    $subBatchIds = $batchUser && isset($batchUser->sub_batches_ids) ? json_decode($batchUser->sub_batches_ids, true) : [];

    // Fetch available batches and sub-batches
    $batches = Batch::where('flag', 1)->get(); // Assuming 'flag' determines active batches
    $subBatches = SubBatch::whereIn('batch_id', $batchIds)->get(); // Fetch sub-batches that belong to the selected batches

    // Pass teacher data, batches, sub-batches, and selected batch and sub-batch IDs to the view
    return view('student.edit_student', compact('student', 'batches', 'subBatches', 'batchIds', 'subBatchIds'));
}

    // function updateStudent(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'batch_ids' => 'array', // Ensure batch_ids is an array
    //         'sub_batch_ids' => 'array', // Ensure sub_batch_ids is an array
    //     ]); 

    //     $student = User::where('role', 'Student')->findOrFail($id);
    //         $student->name = $request->name;
    //         $student->email = $request->email;
    //         $student->save();
    //         // Sync batches and sub-batches with the pivot table
    //          $student->batches()->sync($request->batch_ids ?? [], ['role' => 'Student']);
    //         $student->subBatches()->sync($request->sub_batch_ids ?? [], ['role' => 'Student']);
    //         // Convert batches and sub-batches to JSON format
    //         $batchIds = $request->batches ?? []; // Array of batch IDs
    //         $subBatchIds = $request->sub_batches ?? []; // Array of sub-batch IDs, or empty array

    //     DB::table('batch_user')->updateOrInsert(
    //         ['user_id' => $student->id],
    //         [
    //         'batch_ids' => json_encode($batchIds),// Store batch IDs as JSON
    //         'sub_batches_ids' => json_encode($subBatchIds),
    //         'role' => 'Student',
    //         'updated_at' => now(),
    //     ]
    // );

    //     return redirect()->route('view_student')->with('success', 'Staff updated successfully!');
    // }
    public function updateStudent(Request $request, $id)
{
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'batch_ids' => 'array|nullable',
        'sub_batches_ids' => 'array|nullable', 
    ]);

    
    $student = User::where('role', 'Student')->findOrFail($id);
    
    // Update teacher's name and email in the 'users' table
    $student->name = $request->name;
    $student->email = $request->email;
    $student->save();  // Save to the User table

    // Prepare the data as arrays
    $batchIds = $request->batch_ids ?? [];  // Array of batch IDs
    $subBatchIds = $request->sub_batches_ids ?? [];  // Array of sub-batch IDs (nullable)


    DB::table('batch_user')->updateOrInsert(
        ['user_id' => $student->id],
        [
            'batch_ids' => json_encode($batchIds),  
            'sub_batches_ids' => json_encode($subBatchIds),  
            'role' => 'Student',
            'updated_at' => now(),  // Update the timestamp
        ]
    );

    // Redirect to the staff view page with success message
    return redirect()->route('view_student')->with('success', 'Staff updated successfully!');
}

    function deleteStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('view_student')->with('success', 'Staff deleted successfully!');
    }

    public function getSubBatches($batch_id)
{
    // Assuming you have a relationship between Batch and SubBatch
    $subBatches = Batch::find($batch_id)->subBatches;

    // Return the sub-batches as a JSON response
    return response()->json($subBatches);
}

}
