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


    // public function editSyllabus($id)
    // {
    //     // Fetch the syllabus record by ID
    //     $syllabus = DB::table('syllabus')
    //         ->where('id', $id)
    //         ->where('teacher_id', auth()->id()) // Ensure the syllabus belongs to the logged-in teacher
    //         ->first();

    //     if (!$syllabus) {
    //         return redirect()->route('view_syllabus')->with('error', 'Unauthorized access or syllabus not found.');
    //     }

    //     // Fetch batches and sub-batches
    //     $batches = DB::table('batches')->get();
    //     $subBatches = DB::table('sub_batches')->get();

    //     return view('assignment.edit_syllabus', compact('syllabus', 'batches', 'subBatches'));
    // }

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



    function showClass()
    {
        return view('assignment.assign_class');
    }
    function showLecture()
    {
        return view('assignment.assign_lecture');
    }
}