{{-- 
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{url('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('teacher_dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-folder'></i></div>
                <div class="menu-title">Batches</div>
            </a>
            <ul>
                @forelse ($assignedBatches as $batch)
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <i class='bx bx-folder'></i>
                            <span>{{ $batch->name }}</span>
                        </a>
                        <ul>
                            @forelse ($batch->subBatches as $subBatch)
                                <li>
                                    <a href="#">
                                        <i class='bx bx-radio-circle'></i>
                                        {{ $subBatch->name }}
                                    </a>
                                </li>
                            @empty
                                <li><a>No Sub-Batches Assigned</a></li>
                            @endforelse
                        </ul>
                    </li>
                @empty
                    <li><a>No Batches Assigned</a></li>
                @endforelse
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
 --}}


 <div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{url('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <a href="{{route('main_dashboard')}}" class="">
            <div class="parent-icon"><i class='bx bx-home-alt'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Managemnet</div>
            </a>
            <ul>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                        </div>
                        <div class="menu-title"><i class="bx bx-radio-circle"></i>Syllabus</div>
                    </a>
                    <ul>
                        <li> <a class="" href="{{route('add_syllabus')}}"><i class='fadeIn animated bx bx-radio-circle'></i>Add Syllabus</a>
                        </li>
                        <li> <a class="" href="{{route('view_syllabus')}}"><i class='fadeIn animated bx bx-radio-circle'></i>View Syllabus</a>
                        </li>
                        
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                        </div>
                        <div class="menu-title"><i class="lni lni-network"></i>Class</div>
                    </a>
                    <ul>
                        <li> <a class="" href="{{route('add_class')}}"><i class='bx bx-radio-circle'></i>Add Class</a>
                        </li>
                        <li> <a class="" href="#"><i class='bx bx-radio-circle'></i>View Student</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                        </div>
                        <div class="menu-title"><i class="lni lni-user"></i>Lecture</div>
                    </a>
                    <ul>
                        <li> <a class="" href="{{route('add_lecture')}}"><i class='fadeIn animated bx bx-radio-circle'></i>Add Lectures</a>
                        </li>
                        <li> <a class="" href="#"><i class='fadeIn animated bx bx-radio-circle'></i>View Batch</a>
                        </li>
                        {{-- <li> <a class="" href="{{route('add_SubBatch')}}"><i class='fadeIn animated bx bx-plus-circle'></i>Add Sub Batch</a>
                        </li>
                        <li> <a class="" href="{{route('view_SubBatch')}}"><i class='fadeIn animated bx bx-show'></i>View Sub Batch</a>
                        </li> --}}
                    </ul>
                </li>
            </ul>
        </li>
        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
            <ul>
                <li> <a href="app-emailbox.html"><i class='bx bx-radio-circle'></i>Email</a>
                </li>
                <li> <a href="app-chat-box.html"><i class='bx bx-radio-circle'></i>Chat Box</a>
                </li>
                <li> <a href="app-file-manager.html"><i class='bx bx-radio-circle'></i>File Manager</a>
                </li>
                <li> <a href="app-contact-list.html"><i class='bx bx-radio-circle'></i>Contatcs</a>
                </li>
                <li> <a href="app-to-do.html"><i class='bx bx-radio-circle'></i>Todo List</a>
                </li>
                <li> <a href="app-invoice.html"><i class='bx bx-radio-circle'></i>Invoice</a>
                </li>
                <li> <a href="app-fullcalender.html"><i class='bx bx-radio-circle'></i>Calendar</a>
                </li>
            </ul>
        </li> --}}
       
    </ul>
    <!--end navigation-->
</div>