@extends('head.main_layout')
@section('title','View Staff')
@section('matt')

<div class="wrapper">
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">STAFF</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-user"></i></a></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('add_staff') }}">
                            <button type="button" class="btn btn-primary">Add Staff</button>
                        </a>
                    </div>
                </div>
            </div>
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
                                    <th>Assigned Batch</th>
                                    <th>Assigned Sub Batch</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teachers as $teacher)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td>{{$teacher->name}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->role}}</td>

                                    <!-- Display assigned batches -->
                                    <td>
                                        @if($teacher->batches->isEmpty())
                                        Not Assigned
                                    @else
                                
                                        @foreach ($teacher->batches as $batch)
                                        
                                            {{ $batch->name }} @if (!$loop->last), @endif
                                        @endforeach
                                    @endif
                                    </td>  
                                    
                                    <!-- Display assigned subBatches -->
                                    <td>
                                        @if($teacher->subBatches->isEmpty())
                                            Not Assigned
                                        @else
                                            @foreach ($teacher->subBatches as $subBatch)
                                                {{ $subBatch->name }} @if (!$loop->last), @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('edit_staff', $teacher->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('delete_staff', $teacher->id) }}" class="btn btn-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this staff?')">Delete</a>
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
</div>

@endsection
