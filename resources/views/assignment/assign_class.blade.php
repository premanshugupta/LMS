@extends('teacher.teacher_layout')
@section('title','Add Class')
@section('matter')

<div class="page-wrapper">
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Class</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Class</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('view_syllabus')}}">
                    <button type="button" class="btn btn-primary">View Class</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="card">
                    <div class="card-body">
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

                        <form action="{{ route('add_class') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="multiple-select-optgroup-field">Assign Batch</label>
                                <select name="sub_batch_ids[]" id="multiple-select-optgroup-field" class="form-control" data-placeholder="Choose batches"  multiple required>
                                    @foreach ($batches as $batch)
                                        <optgroup label="{{ $batch->name }}">
                                            @foreach ($subBatches->where('batch_id', $batch->id) as $subBatch)
                                                <option value="{{ $subBatch->id }}">{{ $subBatch->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="class_link">Class Link (Optional)</label>
                                <input type="url" name="class_link" id="class_link" class="form-control" placeholder="Enter class link (e.g., Zoom or YouTube)">
                            </div>
                            <div class="form-group mt-3">
                                <label for="class_file">Upload Class File (PDF/DOC Only)</label>
                                <input type="file" name="class_file" id="class_file" class="form-control" accept=".pdf,.doc,.docx">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3 "> <i class="fadeIn animated bx bx-cloud-upload"></i> Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection