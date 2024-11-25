@extends('head.main_layout')
@section('title','Add Sub Batch')
@section('matt')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">ADD NEW SUB BATCH</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('view_SubBatch')}}">
                    <button type="button" class="btn btn-primary">View Sub Batches</button>
                </a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <form class="row g-3"  action="{{route('add_SubBatch.Post')}}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <label for="input1" class="form-label">Sub Batch</label>
                                <input type="text" class="form-control" id="input1" name="name" placeholder="Add Sub Batch">
                            </div>
                            <div class="col-md-12">
                                <label for="input30" class="form-label">Batch</label>
                                <div class="input-group">
                                    <select class="form-select" name="batch_id" id="input30">
                                        <option selected> Select Batch</option>
                                        @foreach ($batches as $batch)
                                            @if ($batch->flag) <!-- Only active batches -->
                                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                            @endif
                                        @endforeach      
                                      </select>
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-outline-primary px-4">Submit</button>
                                    <button type="button" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>




              


            </div>
        </div>
        <!--end row-->






    </div>
</div>

@endsection