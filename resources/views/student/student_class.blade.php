@extends('student.student_layout')
@section('title', 'Classes')
@section('material')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
                @foreach ($classes as $class)
                    <div class="col">
                        <div class="card radius-10 border-start border-0 border-4 border-success">
                            <div class="card-body">
                                <h5 class="card-title">Class: </h5> <!-- You can dynamically include a class title later -->
                                <p class="card-text"><strong>Shared By:</strong> {{ $class->teacher_name }}</p>
                                <p class="card-text"><strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($class->updated_at)->format('d M, Y') }}</p>
                                @if ($class->file_path)
                                    <!-- Check if PDF file exists -->
                                    <!-- Button to download the PDF -->
                                    {{-- <a href="{{ asset($class->file_path) }}" class="btn btn-success" download>Download PDF</a> --}}

                                    <!-- Button to view the PDF -->
                                    <button type="button" class="btn btn-primary view-btn" data-bs-toggle="modal"
                                        data-bs-target="#viewPdfModal" data-file="{{ asset($class->file_path) }}">
                                        <i class="lni lni-eye"></i> View
                                    </button>
                                @endif

                                @if ($class->class_link)
                                    <!-- Check if video file URL exists -->
                                    <!-- Button to view the video -->
                                    <button type="button" class="btn btn-primary view-video-btn" data-bs-toggle="modal"
                                        data-bs-target="#viewVideoModal" data-video="{{ $class->class_link }}">
                                        <i class="fadeIn animated bx bx-video"></i> Video
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal for viewing PDF -->
    <div class="modal fade" id="viewPdfModal" tabindex="-1" aria-labelledby="viewPdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="" frameborder="0" style="width: 100%; height: 600px;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for playing Video -->
    <div class="modal fade" id="viewVideoModal" tabindex="-1" aria-labelledby="viewVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Embed video using iframe -->
                    <iframe id="videoPlayer" width="100%" height="600px" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- @push('scripts')

@endpush --}}
