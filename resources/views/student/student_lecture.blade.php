@extends('student.student_layout')
@section('title', 'Lectures')
@section('material')

<div class="page-wrapper">
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
            @foreach ($lectures as $lecture)
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-4 border-info">
                        <div class="card-body">
                            <h5 class="card-title">Lecture</h5>
                            <p class="card-text"><strong>Teacher:</strong> {{ $lecture->teacher_name }}</p>
                            <p class="card-text"><strong>Date:</strong>{{ \Carbon\Carbon::parse($lecture->updated_at)->format('d M, Y') }}</p>
                            <!-- View Video Button -->
                            @if ($lecture->video_path)
                                <button type="button" class="btn btn-primary view-video-btn" 
                                        data-bs-toggle="modal" data-bs-target="#videoModal" 
                                        data-video="{{ $lecture->video_path }}">
                                    <i class="fadeIn animated bx bx-video"></i> Video
                                </button>
                            @endif

                            <!-- Open Link Button -->
                            @if ($lecture->class_link)
                                <button type="button" class="btn btn-dark open-link-btn" 
                                        data-bs-toggle="modal" data-bs-target="#linkModal" 
                                        data-link="{{ $lecture->class_link }}">
                                    <i class="fadeIn animated bx bx-link"></i> Link
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal for Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="videoPlayer" src="" frameborder="0" 
                            style="width: 100%; height: 600px;" 
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Link -->
    <div class="modal fade" id="linkModal" tabindex="-1" aria-labelledby="linkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="linkModalLabel">Open Link</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="linkViewer" src="" frameborder="0" 
                            style="width: 100%; height: 600px;" 
                            allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- @push('scripts')

@endpush --}}
