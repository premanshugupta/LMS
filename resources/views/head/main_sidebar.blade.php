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
            <div class="font-18 menu-title">Dashboard</div>
        </a>
        <li class="menu-label">Managemnet</li>
        <li>
            <a href="#" class="has-arrow">
                <div class="parent-icon">
                    <i class='fadeIn animated bx bx-bookmark-plus'></i>
                </div>
                <div class="menu-title">Managemnet</div>
            </a>
            <ul>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                        </div>
                        <div class="menu-title"><i class="lni lni-user"></i>Staff</div>
                    </a>
                    <ul>
                        <li> <a class="" href="{{route('add_staff')}}"><i class='fadeIn animated bx bx-user-plus'></i>Add Staff</a>
                        </li>
                        <li> <a class="" href="{{route('view_staff')}}"><i class='fadeIn animated bx bx-show'></i>View Staff</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                        </div>
                        <div class="menu-title"><i class="lni lni-network"></i>Student</div>
                    </a>
                    <ul>
                        <li> <a class="" href="{{route('add_student')}}"><i class='fadeIn animated bx bx-user-plus'></i>Add Student</a>
                        </li>
                        <li> <a class="" href="{{route('view_student')}}"><i class='fadeIn animated bx bx-show'></i>View Student</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon">
                        </div>
                        <div class="menu-title"><i class="fadeIn animated bx bx-folder"></i>Batch</div>
                    </a>
                    <ul>
                        <li> <a class="" href="{{route('add_Batch')}}"><i class='fadeIn animated bx bx-folder-plus'></i>Add Batch</a>
                        </li>
                        <li> <a class="" href="{{route('view_Batch')}}"><i class='fadeIn animated bx bx-show'></i>View Batch</a>
                        </li>
                        <li> <a class="" href="{{route('add_SubBatch')}}"><i class='fadeIn animated bx bx-folder-plus'></i>Add Sub Batch</a>
                        </li>
                        <li> <a class="" href="{{route('view_SubBatch')}}"><i class='fadeIn animated bx bx-show'></i>View Sub Batch</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        
    </ul>
    <!--end navigation-->
</div>