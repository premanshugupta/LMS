@extends('teacher.teacher_layout')
@section('title','Teacher Dashboard')
@section('matter')
<div class="page-wrapper ">
    <div class="page-content">
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="title pe-3 font-weight-bold"> <b> Hi.
           <span class="text-uppercase">{{ auth()->user()->name }}</span> </b></div>
    <div class="ms-auto">
        <div class="btn-group">
            <div class="title pe-3  font-weight-bold"> <b> {{ now()->setTimezone('Asia/Kolkata') }}</b></div>
        </div>
    </div>
</div>
<hr>
<!--end breadcrumb-->
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-12 col-lg-9 mx-auto">      
                        <p class=" display-1 text-center text-secondary mt-5">Welcome <span id="element"></span> </p>

                <!-- Element to contain animated typing -->


                <!-- Load library from the CDN -->
                <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

                <!-- Setup and start animation! -->
                <script>
                    var typed = new Typed('#element', {
                    strings: ['{{auth()->user()->name}}'],
                    typeSpeed: 80,
                    backspeed:100,
                    //   loop:true
                    });
                </script>
            </div>
        </div>
        <!--end row-->
    </div>
</div>
@endsection