@extends('head.main_layout')
@section('title', 'Admin Dashboard')
@section('matt')

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="title pe-3 font-weight-bold"> <b> Hi.
                       <span class="text-uppercase">{{ auth()->guard('main_head')->user()->name }}</span> </b></div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <div class="title pe-3  font-weight-bold"> <b> {{ now()->setTimezone('Asia/Kolkata') }}</b></div>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
            <div class="page-content">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
					<div class="col">
						<div class="card radius-10 bg-danger">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Staff</p>
										<h4 class="my-1 text-white">{{ $teacherCount }}</h4>
									</div>
									<div class="widgets-icons bg-white text-danger ms-auto"><i class="bx bxs-group"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-info">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-dark">Total Students</p>
										<h4 class="my-1 text-dark">{{ $studentCount }}</h4>
									</div>
									<div class="widgets-icons bg-white text-dark ms-auto"><i class="bx bxs-group"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 bg-success">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Classes</p>
										<h4 class="my-1 text-white">{{ $batchCount }}</h4>
									</div>
									<div class="widgets-icons bg-white text-success ms-auto"><i class="fadeIn animated bx bx-folder"></i></div>
								</div>
							</div>
						</div>
					</div>
                    {{-- end --}}
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

@endsection
