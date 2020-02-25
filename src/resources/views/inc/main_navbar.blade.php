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
        <li class="nav-item dropdown notifications-menu">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-info navbar-badge notification-counter"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification-menu-container">
            </div>
        </li>

        <?php
            $count_mytask = \Cesi\Core\app\Models\CoreTask::where('user_id', cesi_auth()->user()->id)
                ->where('status_id', 1)
                ->count();
            $count_messages = 0;
            $total_avisos = intval($count_mytask) + intval($count_messages);
        ?>

        <!-- Task Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-flag"></i>
                @if ($total_avisos>0)
                    <span class="badge badge-warning navbar-badge">{!! $total_avisos !!}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @if ($count_mytask>0)
                    <span class="dropdown-item dropdown-header"> {!! $count_mytask !!} {{trans('cesi::core.notifications')}}</span>
                @endif
                <div class="dropdown-divider"></div>
                <a href="{!! route( 'admin.core.mytask.list') !!}" class="dropdown-item">
                    <i class="fas fa-tasks mr-2"></i> {!! $count_mytask !!} {{trans('cesi::core.mytask.pendientes')}}
                </a>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> {!! $count_messages !!} {{trans('cesi::core.messages')}}</span>
                </a>
            </div>
        </li>

        <!-- User Dropdown Menu -->
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
