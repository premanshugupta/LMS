@extends('head.main_layout')
@section('title', 'View Batches')
@section('matt')
<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">BATCHES</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-user"></i></a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">Data Table</li> --}}
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{route('add_Batch')}}">
                        <button type="button" class="btn btn-primary">Add Batch</button>
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
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($batches as $batch)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td>{{$batch->name}}</td>
                                    <td>
                                        @if($batch->flag)
                                        {{-- <button class="btn btn-success">Active</button> --}}
                                        <span class="btn btn-success">Active</span>
                                        @else
                                        <span class="btn btn-danger">Deactivated</span>
                                    @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('toggle_batch_status', $batch->id) }}" method="POST" >
                                            @csrf
                                            <button type="submit" class="btn  btn-warning">
                                                {{ $batch->flag ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                               
                                @endforeach
                                
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
