@extends('teacher.teacher_layout')
@section('title','Add Lecture')
@section('matter')

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Lecture</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Lecture</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('view_lectures')}}">
                        <button type="button" class="btn btn-primary">View Assigned Lectures</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Form Start -->
        <form action="{{ route('add_lecture') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <!-- Assign Batch -->
                            <div class="mb-4">
                                <label for="multiple-select-optgroup-field">Assign Batch</label>
                                <select name="sub_batch_ids[]" id="multiple-select-optgroup-field" class="form-control" data-placeholder="Choose batches" multiple required>
                                    @foreach ($batches as $batch)
                                        <optgroup label="{{ $batch->name }}">
                                            @foreach ($subBatches->where('batch_id', $batch->id) as $subBatch)
                                                <option value="{{ $subBatch->id }}">{{ $subBatch->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Class Link -->
                            <div class="form-group mt-3">
                                <label for="class_link">Lecture Link (Optional)</label>
                                <input type="url" name="class_link" id="class_link" class="form-control" placeholder="Enter class link (e.g., Zoom or YouTube)">
                            </div>

                            <!-- Upload Video -->
                            <div class="form-group mt-3">
                                <label for="video_file">Upload Video</label>
                                <input type="file" name="video_file" id="video_file" class="form-control" accept="video/*" required>
                                <small class="form-text text-muted">Accepted formats: MP4, AVI, MOV, etc.</small>
                            </div>

                            <!-- Submit Button -->
                            {{-- <div class="form-group mt-4"> --}}
                                <button type="submit" class="btn btn-primary">Submit</button>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Form End -->

    </div>
</div>


@endsection