@extends('teacher.teacher_layout')
@section('title', 'Edit Syllabus')
@section('matter')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Syllabus</div>
        </div>

        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="card">
                    <div class="card-body">
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

                        <form action="{{ route('update_syllabus', $syllabus->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="multiple-select-optgroup-field" class="form-label">Select Sub-Batches</label>
                                <select class="form-select" name="sub_batch_ids[]" id="multiple-select-optgroup-field" multiple required>
                                    @foreach ($batches as $batch)
                                        <optgroup label="{{ $batch->name }}">
                                            @foreach ($assignedSubBatches->where('batch_id', $batch->id) as $subBatch)
                                                <option value="{{ $subBatch->id }}"
                                                    {{ in_array($subBatch->id, explode(',', $syllabus->sub_batch_id)) ? 'selected' : '' }}>
                                                    {{ $subBatch->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="syllabus_file">Upload New Syllabus (Optional, PDF Only)</label>
                                <input type="file" name="syllabus_file" id="syllabus_file" class="form-control" accept="application/pdf">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                            <a href="{{ route('view_syllabus') }}" class="btn btn-secondary mt-3">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
