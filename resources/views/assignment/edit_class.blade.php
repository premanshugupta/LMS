@extends('teacher.teacher_layout')
@section('title', 'Edit Class')
@section('matter')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Edit Class</h4>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('update_class', $class->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="batch_sub_batch" class="form-label">Batch & Sub-Batch</label>
                        <select class="form-select" name="sub_batch_id" id="batch_sub_batch" required>
                            @foreach ($batches as $batch)
                                <optgroup label="{{ $batch->name }}">
                                    @foreach ($assignedSubBatches->where('batch_id', $batch->id) as $subBatch)
                                        <option value="{{ $subBatch->id }}" 
                                                {{ $subBatch->id == $class->sub_batch_id ? 'selected' : '' }}>
                                            {{ $subBatch->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="class_link" class="form-label">Class Link</label>
                        <input type="url" name="class_link" id="class_link" class="form-control"
                               value="{{ $class->class_link }}" placeholder="Enter Class Link">
                    </div>

                    <div class="mb-4">
                        <label for="class_file" class="form-label">Replace Class File (PDF Only)</label>
                        <input type="file" name="class_file" id="class_file" class="form-control"
                               accept="application/pdf">
                        <small class="text-muted">Leave blank to keep the existing file.</small>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('view_class') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
