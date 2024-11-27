@extends('teacher.teacher_layout')
@section('title','Assign Task')
@section('matter')


<div class="wrapper">
    <div class="page-wrapper">
        <div class="page-content">
            <h4>Assign Task</h4>

            <form id="assignTaskForm">
                @csrf
                
                <!-- Dropdown for Batch and Sub-batch -->
                <div class="mb-3">
                    <label for="batchSelect" class="form-label">Select Batch</label>
                    <select id="batchSelect" name="batch_id" class="form-control">
                        <option value="" selected disabled>-- Select Batch --</option>
                        @foreach($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="subBatchSelect" class="form-label">Select Sub-Batch</label>
                    <select id="subBatchSelect" name="sub_batch_id" class="form-control">
                        <option value="" selected disabled>-- Select Sub-Batch --</option>
                        @foreach($subBatches as $subBatch)
                            <option value="{{ $subBatch->id }}">{{ $subBatch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Option to Select Students -->
                <div class="mb-3">
                    <label for="studentSelect" class="form-label">Or Select Students</label>
                    <select id="studentSelect" class="form-control">
                        <option value="" selected disabled>-- Select to View Students --</option>
                        <option value="view_students">View Students</option>
                    </select>
                </div>

                <!-- Table to Display Students -->
                <div id="studentTableWrapper" style="display: none;">
                    <h5>Students</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Student Name</th>
                                <th>Assigned Batch</th>
                                <th>Assigned Sub-Batch</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $key => $student)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->batch->name ?? 'Not Assigned' }}</td>
                                <td>{{ $student->subBatch->name ?? 'Not Assigned' }}</td>
                                <td>
                                    <input type="checkbox" name="selected_students[]" value="{{ $student->id }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Upload Section -->
                <div id="uploadSection" style="display: none;">
                    <h5>Upload Task</h5>
                    <div class="mb-3">
                        <label for="docFile" class="form-label">Upload Document</label>
                        <input type="file" id="docFile" name="doc_file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Or Provide Link</label>
                        <input type="url" id="link" name="link" class="form-control" placeholder="https://example.com">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Pop-up Modal -->
<div id="uploadModal" class="modal fade" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="modalForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Submit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="modalDocFile" class="form-label">Upload Document</label>
                        <input type="file" id="modalDocFile" name="modal_doc_file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="modalLink" class="form-label">Or Provide Link</label>
                        <input type="url" id="modalLink" name="modal_link" class="form-control" placeholder="https://example.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('studentSelect').addEventListener('change', function() {
        if (this.value === 'view_students') {
            document.getElementById('studentTableWrapper').style.display = 'block';
        } else {
            document.getElementById('studentTableWrapper').style.display = 'none';
        }
    });

    document.querySelector('form#assignTaskForm').addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('uploadSection').style.display = 'block';
    });
</script>


@endsection