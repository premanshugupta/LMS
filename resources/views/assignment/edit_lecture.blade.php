@extends('teacher.teacher_layout')
@section('title', 'Edit Lecture')
@section('matter')

<div class="page-wrapper">
    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h5>Edit Lecture</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update_lecture', $lecture->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="batch" class="form-label">Batch</label>
                        <select id="batch" name="batch_id" class="form-select" required>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}" @if($batch->id == $lecture->batch_id) selected @endif>
                                    {{ $batch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('batch_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sub_batch_id" class="form-label">Sub-Batch</label>
                        <select id="sub_batch_id" name="sub_batch_id" class="form-select" required>
                            @foreach ($assignedSubBatches as $subBatch)
                                <option value="{{ $subBatch->id }}" @if($subBatch->id == $lecture->sub_batch_id) selected @endif>
                                    {{ $subBatch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('sub_batch_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lecture_link" class="form-label">Lecture Link</label>
                        <input type="url" id="lecture_link" name="class_link" class="form-control" value="{{ $lecture->class_link }}">
                        @error('lecture_link') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="lecture_video" class="form-label">Lecture Video</label>
                        <input type="file" id="lecture_video" name="lecture_video" accept="video/*" class="form-control">
                        <small>Leave empty if no update is required.</small>
                        @error('lecture_video') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    @if($lecture->video_path)
                        <div class="mb-3">
                            <label class="form-label">Current Video</label>
                            <video class="w-100" controls>
                                <source src="{{ asset($lecture->video_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
