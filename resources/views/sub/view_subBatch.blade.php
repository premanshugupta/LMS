@extends('head.main_layout')
@section('title','Add Sub Batch')
@section('matt')

<div class="wrapper">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">SUB BATCHES</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-user"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{route('add_SubBatch')}}">
                        <button type="button" class="btn btn-primary">Add Sub Batch</button>
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
                                    <th>Parent Batch Name</th>
                                    <th>Sub Batch Name</th>
                                    <th>Sub Batch Status</th>
                                    <th>Sub Batch Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subBatches as $subBatch)
                                <tr>
                                    {{-- <td> {{$loop->iteration}} </td> --}}
                                    <td> {{$subBatch->batch->name}} </td>    <!--Parent Batch Name-->
                                    <td> {{$subBatch->name}} </td>    <!--Sub-Batch Name-->
                                    <td>
                                        @if($subBatch->flag)
                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>Active</div>
                                        @else
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>De-Active</div>
                                        @endif
                                    
                                    </td> <!-- Sub Batch Status -->
                                    <td>
                                        <form action="{{ route('toggleSubBatchStatus', $subBatch->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')    
                                            <button type="submit" class="btn btn-primary">
                                                {{ $subBatch->flag ? 'De-Active' : 'Active' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No Sub Batches Found</td>
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