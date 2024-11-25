@extends('head.main_layout')
@section('title','Add Staff')
@section('matt')
{{-- <div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Staff</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="fadeIn animated bx bx-plus-circle"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">New Staff</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('add_staff')}}">
                    <button type="button" class="btn btn-primary">Create New</button>
                    </a>    
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="row">
                                <div class="col-xl-6 mx-auto">
                                    <div class="card">
                                        <div class="card-header px-4 py-3">
                                            <h5 class="mb-0">Bootstrap Validation</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <form class="row g-3 needs-validation" novalidate>
                                                <div class="col-md-6">
                                                    <label for="bsValidation1" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="bsValidation1" placeholder="First Name" value="Jhon" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                      </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="bsValidation2" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="bsValidation2" placeholder="Last Name" value="Deo" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                      </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="bsValidation3" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="bsValidation3" placeholder="Phone" required>
                                                    <div class="invalid-feedback">
                                                        Please choose a username.
                                                      </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="bsValidation4" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="bsValidation4" placeholder="Email" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid email.
                                                      </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="bsValidation5" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="bsValidation5" placeholder="Password" required>
                                                    <div class="invalid-feedback">
                                                        Please choose a password.
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="bsValidation6" name="radio-stacked" required>
                                                            <label class="form-check-label" for="bsValidation6">Male</label>
                                                          </div>
                                                          <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="bsValidation7" name="radio-stacked" required>
                                                            <label class="form-check-label" for="bsValidation7">Female</label>
                                                          </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="bsValidation8" class="form-label">DOB</label>
                                                    <input type="date" class="form-control" id="bsValidation8" placeholder="Date of Birth" required>
                                                    <div class="invalid-feedback">
                                                        Please select date.
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="bsValidation9" class="form-label">Country</label>
                                                    <select id="bsValidation9" class="form-select" required>
                                                        <option selected disabled value>...</option>
                                                        <option>One</option>
                                                        <option>Two</option>
                                                        <option>Three</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                       Please select a valid country.
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label for="bsValidation10" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="bsValidation10" placeholder="City" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid city.
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="bsValidation11" class="form-label">State</label>
                                                    <select id="bsValidation11" class="form-select" required>
                                                        <option selected disabled value>Choose...</option>
                                                        <option>One</option>
                                                        <option>Two</option>
                                                        <option>Three</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a valid State.
                                                     </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="bsValidation12" class="form-label">Zip</label>
                                                    <input type="text" class="form-control" id="bsValidation12" placeholder="Zip" required>
                                                    <div class="invalid-feedback">
                                                        Please enter a valid Zip code.
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="bsValidation13" class="form-label">Address</label>
                                                    <textarea class="form-control" id="bsValidation13" placeholder="Address ..." rows="3" required></textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter a valid address.
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="bsValidation14" required>
                                                        <label class="form-check-label" for="bsValidation14">Agree to terms and conditions</label>
                                                        <div class="invalid-feedback">
                                                            You must agree before submitting.
                                                          </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                                                        <button type="reset" class="btn btn-light px-4">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal HTML -->
    

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Staff</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="lni lni-user"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">New Staff</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('view_staff')}}">
                    <button type="button" class="btn btn-primary">View Staff</button>
                </a>
                   
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body p-4">
                        <form class="row g-3 needs-validation" action="{{route('add_staff.post')}}" method="POST"  novalidate>
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

                            <input type="hidden" name="role" value="Teacher">
                            {{-- <div class="col-md-12">
                                <label for="input30" class="form-label">Role</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class='lni lni-user'></i></span>
                                    <select class="form-select" id="input30" name="role">
                                        <option selected disabled value="Teacher">Teacher</option>
                                      </select>
                                  </div>
                            </div> --}}
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