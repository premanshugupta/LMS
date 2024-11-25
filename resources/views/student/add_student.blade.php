@extends('head.main_layout')
@section('title','Add Student')
@section('matt')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Student</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-network"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">New Student</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('view_student')}}">
                    <button type="button" class="btn btn-primary">View Student</button>
                </a>
                   
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <form class="row g-3 needs-validation" action="{{route('add_student.post')}}" method="POST"  novalidate>
                            @csrf
                            <div class="col-md-12">
                                <label for="input25 bsValidation2" class="form-label"> Name</label>
                                 <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-user'></i></span>
                                    <input type="text" class="form-control" name="name" id="input25 bsValidation2" placeholder="Name">
                                    <div class="valid-feedback">
                                        Looks good!
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="bsValidation4" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-envelope'></i></span>
                                    <input type="email" class="form-control" name="email" id="bsValidation4" placeholder="Email">
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                      </div>
                                  </div>
                            </div>
                            <div class="col-md-12">
                                <label for="bsValidation5" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                                    <input type="password" class="form-control" name="password" id="bsValidation5" placeholder="Password">
                                    <div class="invalid-feedback">
                                        Please choose a password.
                                    </div>
                                  </div>
                            </div>

                            <input type="hidden" name="role" value="Student">
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-outline-primary px-4">Submit</button>
                                    <button type="reset" class="btn btn-light px-4">Reset</button>
                                </div>
                            </div>
                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

       
        <!--end row-->


    </div>
</div>

@endsection