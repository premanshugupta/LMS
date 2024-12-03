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
                                {{-- @forelse($teachers as $teacher) --}}
                                @foreach($teachersData as $teacher)
                                <tr>
                                    <td>{{ $teacher['id'] }}</td>
                                    <td>{{ $teacher['name'] }}</td>
                                    <td>{{ $teacher['email'] }}</td>
                                    <td>{{ $teacher['role'] }}</td>

                                    <!-- Display assigned batches -->
                                    <td>
                                    @foreach($teacher['batches'] as $batch)
                                    {{-- <a href="#" class="btn btn-info split-btn-info  text-white fw-bolder btn-small">{{ $batch }}</a>  --}}
                                    <a href="#" class="badge rounded-pill text-white bg-primary bg-gradient p-2 text-uppercase px-3">{{ $batch }}</a> 
                                @endforeach
                                    </td>  
                                    <td>
                                        @foreach($teacher['sub_batches'] as $subBatch)
                                        {{-- <a href="#" class="btn btn-info split-bg-info text-white fw-bolder btn-small">{{ $subBatch }}</a>  --}}
                                        <a href="#" class="badge rounded-pill text-white bg-primary bg-gradient p-2 text-uppercase px-3">{{ $subBatch }}</a> 
                                    @endforeach
                                    </td>

                                    <td>
                                        <a href="{{ route('edit_staff', $teacher['id']) }}" class="btn btn-outline-primary btn-sm"><i class='ms-1 bx bxs-edit'></i></a>
                                        <a href="{{ route('delete_staff', $teacher['id']) }}" class="btn btn-outline-danger btn-sm"
                                           onclick="return confirm('Are you sure you want to delete this staff?')"><i class='ms-1 bx bxs-trash'></i></a>
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
</div>

@endsection
