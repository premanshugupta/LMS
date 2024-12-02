

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
            <a href="{{ route('student_dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-folder'></i></div>
                <div class="menu-title">My Batches</div>
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
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-menu"></i>
                    </div>
                    <div class="menu-title">Menu Levels</div>
                </a>
                <ul>
                    <li> <a class="#" href="{{route('syllabus')}}"><i class='bx bx-radio-circle'></i>Syllabus</a>
                    </li>
                    <li> <a class="#" href="{{route('class')}}"><i class='bx bx-radio-circle'></i>Class</a>
                    </li>
                    <li> <a class="#" href="{{route('lecture')}}"><i class='bx bx-radio-circle'></i>Lecture</a>
                    </li>
                </ul>
            </li>
        </li>
    </ul>
    <!--end navigation-->
</div>
