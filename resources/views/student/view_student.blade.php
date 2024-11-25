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
                                @forelse($students as $student)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->email}}</td>
                                    <td> {{$student->role}} </td>
                                    <td>{{$student->assigned_batch_id ?? 'Not Assigned'}}</td>
                                    <td> {{$student->assigned_sub_batch_id ?? 'Not assigned'}} </td>
                                    <td>
                                        <a href="{{ route('edit_student', $student->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        {{-- <a href="" class="btn btn-primary btn-sm">Edit</a> --}}
                                        <a href="" class="btn btn-info text-white btn-sm">View</a>
                                        <a href="{{ route('delete_student', $student->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Teachers Found</td>
                                </tr>
                                @endforelse
                                
                                {{-- <tr>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                    <td>$320,800</td>
                                </tr> --}}
                                
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
</div>


@endsection