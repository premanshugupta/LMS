@extends('teacher.teacher_layout')
@section('title','View Syllabus')
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
                        <li class="breadcrumb-item active" aria-current="page">View Assigned Syllabus</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('show_syllabus')}}">
                        <button type="button" class="btn btn-primary">Add Syllabus</button>
                    </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Batch</th>
                                <th>Sub Batch</th>
                                <th>Syllabus</th>
                                <th>Update at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($syllabus as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->batch_name }}</td>
                                    <td>{{ $item->sub_batch_name }}</td>
                                    <td>
                                        <a href="{{ asset($item->file_path) }}" class=" btn btn-info text-white btn-sm" download> <i class="ms-1 fadeIn animated bx bx-cloud-download"></i>Download</a>
                                    </td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('edit_syllabus', $item->id) }}" class="btn btn-outline-warning btn-sm"><i class='ms-1 bx bxs-edit'></i></a>
                                        <form action="{{ route('delete_syllabus', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')"><i class='ms-1 bx bxs-trash'></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No syllabus data available</td>
                                </tr>
                            @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection