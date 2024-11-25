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