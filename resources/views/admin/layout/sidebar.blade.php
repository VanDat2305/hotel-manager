<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('bower_components/template-admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Hotel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->image ? Stogate::url(Auth::user()->image) : asset('bower_components/template-admin/dist/img/avatar.png') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="{{__('SEARCH')}}"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item ">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{__('DASHBOARD')}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.category.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                            {{__('CATEGORY')}} 
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.room.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            {{__('ROOM')}}  
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.booking.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            {{__('BOOKING')}}  
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            {{__('USER')}}  
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.customer.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{__('CUSTOMER')}}  
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.statistic')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            {{__('Statistic')}}  
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logOut') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{__('LOGOUT')}} 
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
