@extends('student.student_layout')
@section('title', 'Student Dashboard')
@section('material')


    <div class="page-wrapper ">
        <div class="page-content">
            <!--end breadcrumb-->

            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="title pe-3 text-uppercase font-weight-bold"> <b> Hi. {{ auth()->user()->name }}</b></div>

                <div class="title pe-3 text-uppercase font-weight-bold">
                    @forelse ($assignedBatches as $batch)
                            @forelse ($batch->subBatches as $subBatch)
                            <b> Batch: {{ $subBatch->name }}</b>        
                            @empty
                                <li><a>No Sub-Batches Assigned</a></li>
                            @endforelse
                @empty
                    <li><a>No Batches Assigned</a></li>
                @endforelse
                </div>
                
                <div class="ms-auto">
                    <div class="btn-group">
                        <div class="title pe-3  font-weight-bold"> <b> {{ now()->setTimezone('Asia/Kolkata') }}</b></div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-lg-9 mx-auto">

                    <p class=" display-1 text-center text-secondary mt-5">Welcome <span id="element"></span> </p>

                    <!-- Element to contain animated typing -->


                    <!-- Load library from the CDN -->
                    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

                    <!-- Setup and start animation! -->
                    <script>
                        var typed = new Typed('#element', {
                            strings: ['{{ auth()->user()->name }}'],
                            typeSpeed: 80,
                            backspeed: 100,
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
