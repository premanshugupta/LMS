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
    function addStudent()
    {
        return view('student.add_student');
    }

    function viewStudent(Request $request)
    {
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

    function addStudentPost(Request $request)
    {
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

    public function updateStudent(Request $request, $id)
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


        $student = User::where('role', 'Student')->findOrFail($id);

        // Update teacher's name and email in the 'users' table
        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();  // Save to the User table

        // Prepare the data as arrays
        $batchIds = $request->batch_ids ?? [];  // Array of batch IDs
        $subBatchIds = $request->sub_batches_ids ?? [];  // Array of sub-batch IDs (nullable)

        // Fetch existing batch and sub-batch data for the teacher
        $batchUser = DB::table('batch_user')->where('user_id', $student->id)->first();
        $existingBatchIds = $batchUser ? json_decode($batchUser->batch_ids, true) : [];
        $existingSubBatchIds = $batchUser ? json_decode($batchUser->sub_batches_ids, true) : [];

        // Check if batch_ids or sub_batches_ids have changed
        $isBatchChanged = $batchIds != $existingBatchIds;
        $isSubBatchChanged = $subBatchIds != $existingSubBatchIds;

        if ($isBatchChanged || $isSubBatchChanged) {
            // Only update or insert if there is a change in batch or sub-batch data
            DB::table('batch_user')->updateOrInsert(
                ['user_id' => $student->id],
                [
                    'batch_ids' => json_encode($batchIds),
                    'sub_batches_ids' => json_encode($subBatchIds),
                    'role' => 'Student',
                    'updated_at' => now(), // Update the timestamp
                ]
            );
        }
        // Redirect to the staff view page with success message
        return redirect()->route('view_student')->with('success', 'Staff updated successfully!');
    }

    function deleteStudent($id)
    {
        $student = User::findOrFail($id);
        $student->delete();

        return redirect()->route('view_student')->with('success', 'Staff deleted successfully!');
    }

    public function studentDashboard()
    {
        // Get the authenticated student
        $student = auth()->user();

        // Ensure the user is a student
        if ($student->role !== 'Student') {
            return redirect()->route('home')->with('error', 'Access denied.');
        }

        // Fetch the batch_user record for the student
        $batchUser = DB::table('batch_user')
            ->where('user_id', $student->id)
            ->where('role', 'Student')
            ->first();

        // Check if the student has assigned batches
        if (!$batchUser) {
            return view('student.student_dashboard', ['assignedBatches' => []]);
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

        // Return view with assigned batches and their respective sub-batches
        return view('student.student_dashboard', compact('assignedBatches'));
    }

    // function showSyllabus(){
    //     return view('student.student_syllabus');
    // }

    // function ShowSyllabus()
    // {
    //     $student = auth()->user();

    //     // Fetch assigned sub-batches for the student
    //     $subBatchIds = DB::table('batch_user')
    //         ->where('user_id', $student->id)
    //         ->where('role', 'Student')
    //         ->pluck('sub_batches_ids');

    //     // Fetch syllabus shared with the sub-batches
    //     $syllabi = DB::table('syllabus')
    //         ->join('users', 'syllabus.teacher_id', '=', 'users.id') // Join to get teacher's name
    //         ->whereIn('syllabus.sub_batch_id', $subBatchIds)
    //         ->select('syllabus.id', 'syllabus.file_path', 'syllabus.updated_at', 'users.name as teacher_name')
    //         ->get();

    //     return view('student.student_syllabus', compact('syllabi'));
    // }

    function showSyllabus()
    {
        $student = auth()->user();

        // Step 1: Fetch assigned batches and sub-batches for the logged-in student
        $batchUserRecord = DB::table('batch_user')
            ->where('user_id', $student->id)
            ->where('role', 'Student')
            ->first();

        if (!$batchUserRecord) {
            // No batch or sub-batch assigned to the student
            return redirect()->back()->with('error', 'No batch or sub-batch assigned to you.');
        }

        // Decode batch_ids and sub_batches_ids
        $batchIds = json_decode($batchUserRecord->batch_ids, true) ?? [];
        $subBatchIds = json_decode($batchUserRecord->sub_batches_ids, true) ?? [];

        // Step 2: Fetch syllabi assigned to the sub-batches the student belongs to
        $syllabi = DB::table('syllabus')
            ->join('users', 'syllabus.teacher_id', '=', 'users.id') // Join to get teacher's name
            ->whereIn('syllabus.sub_batch_id', $subBatchIds)
            ->where('syllabus.file_path', 'like', '%.pdf') // Only fetch PDFs
            ->select('syllabus.id', 'syllabus.file_path', 'syllabus.updated_at', 'users.name as teacher_name')
            ->get();

        // Step 3: Pass the data to the view
        return view('student.student_syllabus', compact('syllabi'));
    }



    // function showClass()
    // {
    //     return view('student.student_class');
    // }

//     public function showClass()
// {
//     $student = auth()->user();

//     // Step 1: Fetch assigned batches and sub-batches for the logged-in student
//     $batchUserRecord = DB::table('batch_user')
//         ->where('user_id', $student->id)
//         ->where('role', 'Student')
//         ->first();

//     if (!$batchUserRecord) {
//         // No batch or sub-batch assigned to the student
//         return redirect()->back()->with('error', 'No batch or sub-batch assigned to you.');
//     }

//     // Decode batch_ids and sub_batches_ids
//     $batchIds = json_decode($batchUserRecord->batch_ids, true) ?? [];
//     $subBatchIds = json_decode($batchUserRecord->sub_batches_ids, true) ?? [];

//     // Step 2: Fetch classes assigned to the sub-batches the student belongs to
//     $classes = DB::table('classes')
//         ->join('users', 'classes.teacher_id', '=', 'users.id') // Join to get teacher's name
//         ->whereIn('classes.sub_batch_id', $subBatchIds)
//         ->select('classes.id', 'classes.class_link', 'classes.updated_at', 'users.name as teacher_name')
//         ->get();

//     // Step 3: Pass the data to the view
//     return view('student.student_class', compact('classes'));
// }

public function showClass()
{
    $student = auth()->user();

    // Step 1: Fetch assigned batches and sub-batches for the logged-in student
    $batchUserRecord = DB::table('batch_user')
        ->where('user_id', $student->id)
        ->where('role', 'Student')
        ->first();

    if (!$batchUserRecord) {
        // No batch or sub-batch assigned to the student
        return redirect()->back()->with('error', 'No batch or sub-batch assigned to you.');
    }

    // Decode batch_ids and sub_batches_ids
    $batchIds = json_decode($batchUserRecord->batch_ids, true) ?? [];
    $subBatchIds = json_decode($batchUserRecord->sub_batches_ids, true) ?? [];

    // Step 2: Fetch classes and related PDFs assigned to the sub-batches the student belongs to
    $classes = DB::table('classes')
        ->join('users', 'classes.teacher_id', '=', 'users.id') // Join to get teacher's name
        ->whereIn('classes.sub_batch_id', $subBatchIds)
        ->select('classes.id', 'classes.class_link', 'classes.file_path', 'classes.updated_at', 'users.name as teacher_name')
        ->get();

    // Step 3: Pass the data to the view
    return view('student.student_class', compact('classes'));
}


    // function showLecture()
    // {
    //     return view('student.student_lecture');
    // }

    public function showLecture()
{
    $student = auth()->user();

    // Fetch assigned batches and sub-batches for the logged-in student
    $batchUserRecord = DB::table('batch_user')
        ->where('user_id', $student->id)
        ->where('role', 'Student')
        ->first();

    if (!$batchUserRecord) {
        // No batch or sub-batch assigned to the student
        return redirect()->back()->with('error', 'No batch or sub-batch assigned to you.');
    }

    // Decode batch_ids and sub_batches_ids
    $batchIds = json_decode($batchUserRecord->batch_ids, true) ?? [];
    $subBatchIds = json_decode($batchUserRecord->sub_batches_ids, true) ?? [];

    // Fetch lecture data assigned to the sub-batches the student belongs to
    $lectures = DB::table('lectures')
        ->join('users', 'lectures.teacher_id', '=', 'users.id') // Join to get teacher's name
        ->whereIn('lectures.sub_batch_id', $subBatchIds)
        ->select('lectures.id', 'lectures.video_path', 'lectures.class_link', 'lectures.updated_at', 'users.name as teacher_name')
        ->get();

    // Pass data to the view
    return view('student.student_lecture', compact('lectures'));
}

}
