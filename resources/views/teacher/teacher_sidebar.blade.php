<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <a href="{{route('teacher_dashboard')}}" >
            <div class="parent-icon"><i class='bx bx-home-alt'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Batches</div>
            </a>
            <ul>
                <li> <a href="{{route('assign_task')}}"><i class='bx bx-radio-circle'></i>Assign Task</a>
                </li>
                <li> <a href="{{route('assign_class')}}"><i class='bx bx-radio-circle'></i>Assign Class</a>
                </li>
                <li> <a href="{{route('assign_lecture')}}"><i class='bx bx-radio-circle'></i>Assign Lectures</a>
                </li>
            </ul>
        </li>
    
    </ul>
    <!--end navigation-->
</div>