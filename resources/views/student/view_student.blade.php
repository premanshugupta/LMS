@extends('head.main_layout')
@section('title','Add Student')
@section('matt')

<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">STUDENT</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-network"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Data Table</li> --}}
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{route('add_student')}}">
                        <button type="button" class="btn btn-primary">Add Student</button>
                    </a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.no.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Assign Batch</th>
                                    <th>Assign Sub Batch</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($studentsData as $student)
                                <tr>
                                    <td> {{$student['id']}} </td>
                                    <td>{{$student['name']}}</td>
                                    <td>{{$student['email']}}</td>
                                    <td> {{$student['role']}} </td>
                                    <td>
                                        @foreach($student['batches'] as $batch)
                                        <a href="#" class="btn btn-info split-btn-info text-white fw-bolder btn-small">{{ $batch ?? 'Not Assigned' }}</a> 
                                    @endforeach
                                        </td>  
                                        <td>
                                            @foreach($student['sub_batches'] as $subBatch)
                                            <a href="#" class="btn btn-info split-bg-info text-white fw-bolder btn-small">{{ $subBatch ?? 'Not Assigned' }}</a> 
                                        @endforeach
                                        </td>
                                    <td>
                                        <a href="{{ route('edit_student', $student['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        {{-- <a href="" class="btn btn-primary btn-sm">Edit</a> --}}
                                        {{-- <a href="" class="btn btn-info text-white btn-sm">View</a> --}}
                                        <a href="{{ route('delete_student', $student['id']) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Teachers Found</td>
                                </tr>
                                @endforelse
                                
                               
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</div>


@endsection