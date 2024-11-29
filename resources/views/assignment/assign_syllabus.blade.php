@extends('teacher.teacher_layout')
@section('title', 'Add Syllabus')
@section('matter')


    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Syllabus</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Syllabus</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{route('view_syllabus')}}">
                        <button type="button" class="btn btn-primary">View Syllabus</button>
                        </a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
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
                            {{-- <form action="{{ route('add_syllabus') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="multiple-select-optgroup-field" class="form-label">Select Batch</label>
                                <select class="form-select" name="sub_batch_ids[]" id="multiple-select-optgroup-field"
                                    data-placeholder="Choose anything" multiple>

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
                                <label for="syllabus_file">Upload Syllabus (PDF Only)</label>
                                <input type="file" name="syllabus_file" id="syllabus_file" class="form-control"
                                       accept="application/pdf" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form> --}}
                        <form action="{{ route('add_syllabus') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        
                            <div class="mb-4">
                                <label for="multiple-select-optgroup-field" class="form-label">Select Sub-Batches</label>
                                <select class="form-select" name="sub_batch_ids[]" id="multiple-select-optgroup-field"
                                        data-placeholder="Choose sub-batches" multiple required>
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
                                <label for="syllabus_file">Upload Syllabus (PDF Only)</label>
                                <input type="file" name="syllabus_file" id="syllabus_file" class="form-control"
                                       accept="application/pdf" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                        
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>


@endsection

<!-- Syllabus Form -->
{{-- <form action="{{ route('add_syllabus') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="batch_id">Batch</label>
        <select name="batch_id" id="batch_id" class="form-control" required>
            <option value="">-- Select Batch --</option>
            @foreach ($batches as $batch)
                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="sub_batch_id">Sub-Batch</label>
        <select name="sub_batch_id" id="sub_batch_id" class="form-control" required>
            <option value="">-- Select Sub-Batch --</option>
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
        <label for="syllabus_file">Upload Syllabus (PDF Only)</label>
        <input type="file" name="syllabus_file" id="syllabus_file" class="form-control"
            accept="application/pdf" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form> --}}
{{-- <form action="{{ route('add_syllabus') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="sub_batch_id">Sub-Batches (Grouped by Batches)</label>
        <select name="sub_batch_ids[]" id="sub_batch_id" class="form-control" multiple required>
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
        <label for="syllabus_file">Upload Syllabus (PDF Only)</label>
        <input type="file" name="syllabus_file" id="syllabus_file" class="form-control"
               accept="application/pdf" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
 --}}