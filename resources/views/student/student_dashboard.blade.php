@extends('student.student_layout')
@section('title','Student Dashboard')
@section('material')

{{-- Welcome Message  --}}
  <!-- Element to contain animated typing -->
  {{-- <span id="element"></span>

  <!-- Load library from the CDN -->
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

  <!-- Setup and start animation! -->
  <script>
    var typed = new Typed('#element', {
      strings: ['{{auth()->user()->name}}'],
      typeSpeed: 80,
      backspeed:100,
      loop:true
    });
  </script> --}}
  
    <!--sidebar wrapper -->
    <!--end sidebar wrapper -->
    <!--start header -->
  
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper ">
        <div class="page-content">
            <!--end breadcrumb-->
            <div class="row">
                <div class="col-12 col-lg-9 mx-auto">      
                    {{-- <div class="card">
                        <div class="card-body">
                            <ul class="list-inline mb-0">
                                <li class=" display-1 text-center text-secondary ">Welcome <span id="element"></span> </li>

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
                            </ul>
                        </div>
                    </div> --}}
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
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->


@endsection