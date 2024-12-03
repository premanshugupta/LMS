{{-- @extends('student.student_layout')
@section('title', 'Syllabus')
@section('material')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h5 class="card-title">Topic: </h5>
                            </div>
                            <p class="card-text">Share By: </p>
                            <p class="card-text">Date: </p>
                            <a href="javascript:;" class="btn btn-primary">Download</a>
                            <a href="javascript:;" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    @endsection --}}


@extends('student.student_layout')
@section('title', 'Syllabus')
@section('material')

<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
            @foreach ($syllabi as $syllabus)
    <div class="col">
        <div class="card radius-10 border-start border-0 border-5 border-danger">
            <div class="card-body">
                <h5 class="card-title">Topic: </h5> <!-- Add dynamic topic if needed -->
                <p class="card-text"><strong>Shared By:</strong> {{ $syllabus->teacher_name }}</p>
                <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($syllabus->updated_at)->format('d M, Y') }}</p>
                <a href="{{ asset($syllabus->file_path) }}" class="btn btn-primary" download><i class="fadeIn animated bx bx-cloud-download"></i> Download</a>

                <!-- Show View button only if the file is a PDF -->
                @if (str_ends_with($syllabus->file_path, '.pdf'))
                    <button type="button" class="btn btn-primary view-btn" data-bs-toggle="modal" data-bs-target="#viewModal" data-file="{{ asset($syllabus->file_path) }}">
                       <i class="lni lni-eye"></i> View
                    </button>
                @endif
            </div>
        </div>
    </div>
@endforeach

        </div>
    </div>

    <!-- Modal for viewing files -->
   <!-- Modal for viewing PDF -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="fileViewer" src="" frameborder="0" style="width: 100%; height: 600px;"></iframe>
            </div>
        </div>
    </div>
</div>

@endsection


