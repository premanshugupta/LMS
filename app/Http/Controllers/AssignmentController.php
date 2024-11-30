<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\SubBatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    // function showSyllabus(){
    //     return view('assignment.assign_syllabus');
    // }

    public function showSyllabus()
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch active batches and sub-batches assigned to the teacher
        $batchUserRecords = DB::table('batch_user')
            ->where('user_id', $teacher->id)
            ->where('role', 'Teacher')
            ->get();

        $batchIds = [];
        $subBatchIds = [];

        foreach ($batchUserRecords as $record) {
            $batchIds = array_merge($batchIds, json_decode($record->batch_ids, true));
            $subBatchIds = array_merge($subBatchIds, json_decode($record->sub_batches_ids, true));
        }

        $batches = Batch::whereIn('id', $batchIds)->where('flag', 1)->get();
        $subBatches = SubBatch::whereIn('id', $subBatchIds)->where('flag', 1)->get();

        return view('assignment.assign_syllabus', compact('batches', 'subBatches'));
    }


    public function addSyllabus(Request $request)
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Validate the request
        $validatedData = $request->validate([
            'sub_batch_ids' => 'required|array|min:1', // Ensure at least one sub-batch is selected
            'sub_batch_ids.*' => 'exists:sub_batches,id', // Validate each sub-batch ID
            'syllabus_file' => 'required|file|mimes:pdf', // Validate the uploaded file
        ]);

        // Save the uploaded PDF file
        $filePath = null;
        if ($request->hasFile('syllabus_file')) {
            if (!file_exists(public_path('/uploads/syllabus'))) {
                mkdir(public_path('/uploads/syllabus'), 0777, true);
            }
            $fileName = rand(100000, 99999999) . '.' . $request->file('syllabus_file')->getClientOriginalExtension();
            $request->file('syllabus_file')->move(public_path('/uploads/syllabus'), $fileName);

            $filePath = '/uploads/syllabus/' . $fileName;
        }

        // Loop through each selected sub-batch ID and derive its batch ID
        foreach ($validatedData['sub_batch_ids'] as $subBatchId) {
            $subBatch = SubBatch::findOrFail($subBatchId);
            $batchId = $subBatch->batch_id;

            // Insert the record into the syllabus table
            DB::table('syllabus')->insert([
                'teacher_id' => $teacher->id,
                'batch_id' => $batchId,
                'sub_batch_id' => $subBatchId,
                'file_path' => $filePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('show_syllabus')->with('success', 'Syllabus uploaded successfully.');
    }
    //  function viewSyllabus(){
    //     return view('assignment.view_syllabus');
    //  }
    public function viewSyllabus()
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch the syllabus data added by this teacher
        $syllabus = DB::table('syllabus')
            ->join('batches', 'syllabus.batch_id', '=', 'batches.id')
            ->join('sub_batches', 'syllabus.sub_batch_id', '=', 'sub_batches.id')
            ->where('syllabus.teacher_id', $teacher->id)
            ->select('syllabus.*', 'batches.name as batch_name', 'sub_batches.name as sub_batch_name')
            ->get();

        return view('assignment.view_syllabus', compact('syllabus'));
    }

    public function deleteSyllabus($id)
    {
        $syllabus = DB::table('syllabus')->where('id', $id)->first();

        // Check if syllabus belongs to the logged-in teacher
        if ($syllabus && $syllabus->teacher_id == auth()->id()) {
            // Delete the file
            if (file_exists(public_path($syllabus->file_path))) {
                unlink(public_path($syllabus->file_path));
            }

            // Delete the database record
            DB::table('syllabus')->where('id', $id)->delete();

            return redirect()->route('view_syllabus')->with('success', 'Syllabus deleted successfully.');
        }

        return redirect()->route('view_syllabus')->with('error', 'Unauthorized access.');
    }


    public function editSyllabus($id)
    {
        // Fetch the syllabus record by ID
        $syllabus = DB::table('syllabus')
            ->where('id', $id)
            ->where('teacher_id', auth()->id()) // Ensure the syllabus belongs to the logged-in teacher
            ->first();

        if (!$syllabus) {
            return redirect()->route('view_syllabus')->with('error', 'Unauthorized access or syllabus not found.');
        }

        // Fetch sub-batches assigned to this syllabus
        $assignedSubBatches = DB::table('sub_batches')
            ->whereIn('id', explode(',', $syllabus->sub_batch_id))
            ->get();

        // Fetch their respective batch information
        $batches = DB::table('batches')
            ->whereIn('id', $assignedSubBatches->pluck('batch_id')->unique())
            ->get();

        return view('assignment.edit_syllabus', compact('syllabus', 'batches', 'assignedSubBatches'));
    }


    public function updateSyllabus(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'sub_batch_ids' => 'required|array',
            'sub_batch_ids.*' => 'exists:sub_batches,id',
            'syllabus_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $syllabus = DB::table('syllabus')->where('id', $id)->first();

        if (!$syllabus || $syllabus->teacher_id != auth()->id()) {
            return redirect()->route('view_syllabus')->with('error', 'Unauthorized access or syllabus not found.');
        }

        // Handle file upload (if provided)
        $filePath = $syllabus->file_path; // Keep the existing file path if no new file is uploaded
        if ($request->hasFile('syllabus_file')) {
            // Delete the old file
            if (file_exists(public_path($syllabus->file_path))) {
                unlink(public_path($syllabus->file_path));
            }

            // Upload the new file
            if (!file_exists(public_path('/uploads/syllabus'))) {
                mkdir(public_path('/uploads/syllabus'), 0777, true);
            }
            $classFileName = rand(100000, 99999999) . '.' . $request->file('syllabus_file')->getClientOriginalExtension();
            $request->file('syllabus_file')->move(public_path('/uploads/syllabus'), $classFileName);

            $filePath = '/uploads/syllabus/' . $classFileName;
        }

        // Update the syllabus record in the database
        DB::table('syllabus')
            ->where('id', $id)
            ->update([
                'sub_batch_id' => implode(',', $validatedData['sub_batch_ids']), // Save multiple sub-batch IDs as a comma-separated string
                'file_path' => $filePath,
                'updated_at' => now(),
            ]);

        return redirect()->route('view_syllabus')->with('success', 'Syllabus updated successfully.');
    }

    // ADD CLASS BELOW

    function showClass()
    {
        return view('assignment.assign_class');
    }

    public function addClass(Request $request)
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch assigned batches and sub-batches for the teacher
        $batchUserRecords = DB::table('batch_user')
            ->where('user_id', $teacher->id)
            ->where('role', 'Teacher')
            ->get();

        $batchIds = [];
        $subBatchIds = [];

        foreach ($batchUserRecords as $record) {
            $batchIds = array_merge($batchIds, json_decode($record->batch_ids, true));
            $subBatchIds = array_merge($subBatchIds, json_decode($record->sub_batches_ids, true));
        }

        $batches = Batch::whereIn('id', $batchIds)->where('flag', 1)->get();
        $subBatches = SubBatch::whereIn('id', $subBatchIds)->where('flag', 1)->get();

        // Handle form submission
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'sub_batch_ids' => 'required|array|min:1',
                'sub_batch_ids.*' => 'exists:sub_batches,id',
                'class_link' => 'nullable|url',
                'class_file' => 'nullable|file|mimes:pdf,doc,docx',
            ]);

            // Handle file upload
            $filePath = null;
            if ($request->hasFile('class_file')) {
                if (!file_exists(public_path('/uploads/classes'))) {
                    mkdir(public_path('/uploads/classes'), 0777, true);
                }
                $fileName = uniqid() . '.' . $request->file('class_file')->getClientOriginalExtension();
                $request->file('class_file')->move(public_path('/uploads/classes'), $fileName);
                $filePath = '/uploads/classes/' . $fileName;
            }

            // Insert data for each sub-batch
            foreach ($validatedData['sub_batch_ids'] as $subBatchId) {
                DB::table('classes')->insert([
                    'teacher_id' => $teacher->id,
                    'batch_id' => SubBatch::find($subBatchId)->batch_id, // Get batch_id from subBatch
                    'sub_batch_id' => $subBatchId,
                    'class_link' => $validatedData['class_link'] ?? null,
                    'file_path' => $filePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Class added successfully.');
        }

        return view('assignment.assign_class', compact('batches', 'subBatches'));
    }

    public function viewClass()
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch classes added by the teacher
        $classes = DB::table('classes')
            ->join('batches', 'classes.batch_id', '=', 'batches.id')
            ->join('sub_batches', 'classes.sub_batch_id', '=', 'sub_batches.id')
            ->where('classes.teacher_id', $teacher->id)
            ->select(
                'classes.id',
                'batches.name as batch_name',
                'sub_batches.name as sub_batch_name',
                'classes.class_link',
                'classes.file_path',
                'classes.updated_at'
            )
            ->orderBy('classes.updated_at', 'desc')
            ->get();

        return view('assignment.view_class', compact('classes'));
    }


    public function editClass($id)
    {
        // Fetch the class record by ID
        $class = DB::table('classes')
            ->where('id', $id)
            ->where('teacher_id', auth()->id()) // Ensure the class belongs to the logged-in teacher
            ->first();

        if (!$class) {
            return redirect()->route('view_class')->with('error', 'Unauthorized access or class not found.');
        }

        // Fetch sub-batches assigned to this class
        $assignedSubBatches = DB::table('sub_batches')
            ->whereIn('id', explode(',', $class->sub_batch_id))
            ->get();

        // Fetch their respective batch information
        $batches = DB::table('batches')
            ->whereIn('id', $assignedSubBatches->pluck('batch_id')->unique())
            ->get();

        return view('assignment.edit_class', compact('class', 'batches', 'assignedSubBatches'));
    }

    public function updateClass(Request $request, $id)
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch the class to ensure it belongs to the logged-in teacher
        $class = DB::table('classes')->where('id', $id)->where('teacher_id', $teacher->id)->first();

        if (!$class) {
            return redirect()->route('view_class')->with('error', 'Class not found or unauthorized.');
        }

        // Validate the request
        $validatedData = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'sub_batch_id' => 'required|exists:sub_batches,id',
            'class_link' => 'nullable|url',
            'class_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle file upload if provided
        $filePath = $class->file_path; // Keep existing file path if no new file is uploaded
        if ($request->hasFile('class_file')) {
            if ($filePath && file_exists(public_path($filePath))) {
                unlink(public_path($filePath)); // Delete old file
            }

            $fileName = uniqid() . '.' . $request->file('class_file')->getClientOriginalExtension();
            $filePath = '/uploads/classes/' . $fileName;

            $request->file('class_file')->move(public_path('/uploads/classes'), $fileName);
        }

        // Update the class record
        DB::table('classes')->where('id', $id)->update([
            'batch_id' => $validatedData['batch_id'],
            'sub_batch_id' => $validatedData['sub_batch_id'],
            'class_link' => $validatedData['class_link'],
            'file_path' => $filePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('view_class')->with('success', 'Class updated successfully.');
    }



    public function deleteClass($id)
    {
        // Ensure the logged-in teacher owns the class
        $class = DB::table('classes')->where('id', $id)->where('teacher_id', auth()->id())->first();

        if (!$class) {
            return redirect()->back()->with('error', 'Class not found or unauthorized.');
        }

        // Delete file if it exists
        if ($class->file_path && file_exists(public_path($class->file_path))) {
            unlink(public_path($class->file_path));
        }

        // Delete the class record
        DB::table('classes')->where('id', $id)->delete();

        return redirect()->route('view_class')->with('success', 'Class deleted successfully.');
    }

    public function showLecture()
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch assigned batches and sub-batches for the teacher
        $batchUserRecords = DB::table('batch_user')
            ->where('user_id', $teacher->id)
            ->where('role', 'Teacher')
            ->get();

        $batchIds = [];
        $subBatchIds = [];

        foreach ($batchUserRecords as $record) {
            $batchIds = array_merge($batchIds, json_decode($record->batch_ids, true) ?? []);
            $subBatchIds = array_merge($subBatchIds, json_decode($record->sub_batches_ids, true) ?? []);
        }

        // Fetch batches and sub-batches
        $batches = Batch::whereIn('id', $batchIds)->where('flag', 1)->get();
        $subBatches = SubBatch::whereIn('id', $subBatchIds)->where('flag', 1)->get();

        // Pass batches and sub-batches to the view
        return view('assignment.assign_lecture', compact('batches', 'subBatches'));
    }


    public function addLecture(Request $request)
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch assigned batches and sub-batches for the teacher
        $batchUserRecords = DB::table('batch_user')
            ->where('user_id', $teacher->id)
            ->where('role', 'Teacher')
            ->get();

        $batchIds = [];
        $subBatchIds = [];

        foreach ($batchUserRecords as $record) {
            $batchIds = array_merge($batchIds, json_decode($record->batch_ids, true) ?? []);
            $subBatchIds = array_merge($subBatchIds, json_decode($record->sub_batches_ids, true) ?? []);
        }

        // Fetch batches and sub-batches
        $batches = Batch::whereIn('id', $batchIds)->where('flag', 1)->get();
        $subBatches = SubBatch::whereIn('id', $subBatchIds)->where('flag', 1)->get();

        // If no batches or sub-batches are found, handle gracefully
        if ($batches->isEmpty() || $subBatches->isEmpty()) {
            return redirect()->back()->with('error', 'No batches or sub-batches assigned to this teacher.');
        }

        // Handle form submission   
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'sub_batch_ids' => 'required|array|min:1',
                'sub_batch_ids.*' => 'exists:sub_batches,id',
                'class_link' => 'nullable|url',
                'video_file' => 'nullable', // Video validation: max size 50MB
            ]);

            // Handle video upload
            $videoPath = null;
            if ($request->hasFile('video_file')) {
                if (!file_exists(public_path('/uploads/lecture'))) {
                    mkdir(public_path('/uploads/lecture'), 0777, true);
                }
                $fileName = uniqid() . '.' . $request->file('video_file')->getClientOriginalExtension();
                $request->file('video_file')->move(public_path('/uploads/lecture'), $fileName);
                $videoPath = '/uploads/lecture/' . $fileName;
            }

            // Insert data for each sub-batch
            foreach ($validatedData['sub_batch_ids'] as $subBatchId) {
                DB::table('lectures')->insert([
                    'teacher_id' => $teacher->id,
                    'batch_id' => SubBatch::find($subBatchId)->batch_id, // Get batch_id from SubBatch
                    'sub_batch_id' => $subBatchId,
                    'class_link' => $validatedData['class_link'] ?? null,
                    'video_path' => $videoPath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Lecture added successfully.');
        }

        return view('assignment.assign_lecture', compact('batches', 'subBatches'));
    }

    public function viewLecture()
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Fetch the teacher's lectures
        $lectures = DB::table('lectures')
            ->where('teacher_id', $teacher->id)
            ->join('batches', 'lectures.batch_id', '=', 'batches.id')  // Join with the batches table to get batch names
            ->join('sub_batches', 'lectures.sub_batch_id', '=', 'sub_batches.id')  // Join with the sub-batches table to get sub-batch names
            ->select('lectures.*', 'batches.name as batch_name', 'sub_batches.name as sub_batch_name')
            ->get();

        // Ensure the video_path is accessible as a public URL
        foreach ($lectures as $lecture) {
            $lecture->video_path = asset($lecture->video_path); // Fix the video path to use asset()
        }
        // Pass the lectures to the view
        return view('assignment.view_lecture', compact('lectures'));
    }

    public function deleteLecture($id)
    {
        // Get the logged-in teacher
        $teacher = auth()->user();

        // Find the lecture by its ID and ensure it's the correct teacher's lecture
        $lecture = DB::table('lectures')
            ->where('teacher_id', $teacher->id)
            ->where('id', $id)
            ->first();

        // Check if lecture exists
        if ($lecture) {
            // Delete the lecture record
            DB::table('lectures')->where('id', $id)->delete();

            // Optionally, delete the video file if it exists
            if ($lecture->video_path && file_exists(public_path($lecture->video_path))) {
                unlink(public_path($lecture->video_path));
            }

            return redirect()->route('view_lectures')->with('success', 'Lecture deleted successfully.');
        }

        return redirect()->route('view_lectures')->with('error', 'Lecture not found.');
    }
}
