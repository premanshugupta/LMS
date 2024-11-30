{{-- <div class="sidebar-wrapper" data-simplebar="true">
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
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
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
</div> --}}
{{-- <div class="sidebar-wrapper" data-simplebar="true">
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
</div> --}}

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
        </li>
    </ul>
    <!--end navigation-->
</div>
