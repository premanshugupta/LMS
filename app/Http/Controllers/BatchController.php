<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\SubBatch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    function addBatch()
    {
        return view('batch.add_batch');
    }

    function addBatchPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Batch::create([
            'name' => $request->name,
            'flag' => 1, // Default to active
        ]);

        return redirect()->route('view_Batch')->with('success', 'Batch created successfully!');
    }

    function viewBatch()
    {
        $batches = Batch::all();
        return view('batch.view_batch', compact('batches'));
    }


    function toggleBatchStatus($id)
    {
        $batch = Batch::findOrFail($id);

        // Toggle the flag
        $batch->flag = !$batch->flag;
        $batch->save();
        // Update flags for all associated sub-batches
        SubBatch::where('batch_id', $batch->id)->update(['flag' => $batch->flag]);

        $status = $batch->flag ? 'activated' : 'deactivated';
        return redirect()->route('view_Batch')->with('success', "Batch $status successfully!");
    }
}
