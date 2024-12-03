@extends('teacher.teacher_layout')
@section('title', 'View Lectures')
@section('matter')

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Lectures</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Assigned Lecture</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('add_lecture')}}">
                        <button type="button" class="btn btn-primary">Add Lecture</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Table of Lectures -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Batch</th>
                            <th>Sub-Batch</th>
                            <th>Class Link</th>
                            <th>Video</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lectures as $lecture)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lecture->batch_name }}</td>
                                <td>{{ $lecture->sub_batch_name }}</td>
                                <td>
                                    @if($lecture->class_link)
                                        <a href="{{ $lecture->class_link }}" target="_blank" class="btn btn-primary btn-sm text-white"><i class="fadeIn animated bx bx-link"></i> Link</a>
                                    @else
                                        <a href="#" class="btn btn-primary btn-sm"> No link</a>
                                    @endif
                                </td>
                                <td>
                                    @if($lecture->video_path)
                                        <button class="btn btn-info view-video-btn btn-sm text-white" data-video="{{ asset($lecture->video_path) }}" data-bs-toggle="modal" data-bs-target="#videoModal"><i class="fadeIn animated bx bx-video"></i> Video</button>
                                    @else
                                        <a href="#" class="btn btn-info btn-sm text-white">No Video</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('edit_lecture',$lecture->id)}}" class="btn btn-outline-warning btn-sm"><i class="ms-1 bx bxs-edit"></i></a>
                                    <!-- Delete Button with Confirmation -->
                                    <form action="{{ route('delete_lecture', $lecture->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this lecture?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="ms-1 bx bxs-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>

    </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Lecture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <video id="videoPlayer" class="w-100" controls>
                    <source id="videoSource" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

@section('scripts')

<script>
    document.querySelectorAll('.view-video-btn').forEach(function(button) {

        button.addEventListener('click', function() {
            var videoSrc = button.getAttribute('data-video');
            var videoPlayer = document.getElementById('videoPlayer');
            var videoSource = document.getElementById('videoSource');

            // Wait for modal to fully open before setting video source
            $('#videoModal').on('shown.bs.modal', function () {
                console.log(videoSrc,videoSource);
                
                videoSource.setAttribute('src', videoSrc);
                videoPlayer.load();  // Reload the video player with the new source
            });
        });
    });
</script>

@endsection
@endsection

