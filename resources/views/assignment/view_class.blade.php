@extends('teacher.teacher_layout')
@section('title', 'View Class')
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
                        <li class="breadcrumb-item active" aria-current="page">View Class</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('add_class')}}">
                    <button type="button" class="btn btn-primary">Add Class</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">View Classes</h4>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Batch</th>
                            <th>Sub Batch</th>
                            <th>Class</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $key => $class)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $class->batch_name }}</td>
                                <td>{{ $class->sub_batch_name }}</td>
                                <td>
                                    @if ($class->file_path)
                                        <a href="{{ asset($class->file_path) }}" class="btn btn-info text-white btn-sm" download><i class="fadeIn animated bx bx-cloud-download"></i> Download</a>
                                    @endif
                                    @if ($class->class_link)
                                        <a href="{{ $class->class_link }}" class="btn btn-primary btn-sm" target="_blank"><i class="fadeIn animated bx bx-link"></i> Link</a>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($class->updated_at)->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('edit_class', $class->id) }}" class="btn btn-outline-warning btn-sm"><i class="ms-1 bx bxs-edit"></i> </a>
                                    <form action="{{ route('delete_class', $class->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this class?');">
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

@endsection
