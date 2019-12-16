<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <div class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>

                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ cesi_auth()->user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <!-- The user image in the menu -->
                <div class="dropdown-item dropdown-header user-header">
                    @if (cesi_auth()->user()->avatar == null)
                        <img src="{{ asset('vendor/cesi/core/img/user_avatar.png') }}" class="img-circle" alt="User Image">
                    @else
                        <img src="{{cesi_auth()->user()->avatar}}" class="img-circle" alt="User Image">
                    @endif
                    <p>
                        @if (cesi_auth()->user()->social_name == null)
                            {{ cesi_auth()->user()->name}}
                        @else
                            {{ cesi_auth()->user()->social_name}}
                        @endif
                        <small>{{-- $carbon->format('Y-m-d') --}}</small>
                    </p>

                </div>

                <div class="dropdown-divider"></div>

                <!-- Menu Footer-->
                <div class="user-footer">
                    <div class="float-left">
                        <a href="#" class="btn btn-default btn-flat">{{ trans('cesi::core.dashboard.user.profile') }}</a>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-default btn-flat" href="{{ cesi_url('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ trans('cesi::core.dashboard.user.logout') }}
                        </a>

                        <form id="logout-form" action="{{ cesi_url('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->