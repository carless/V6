<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('cesi::inc.head')

        <link rel="stylesheet" href="{{ asset('vendor/cesi/core/css/login.css') }}">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/') }}" class="logo">
                    <img title="{{ config('cesi.core.project_name') }}" src="{{ asset('vendor/cesi/core/img/logo_cesi.png') }}" style='max-width: 100%;'/>
                </a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class='alert alert-warning'>
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form role="form" method="POST" action="{{ route('cesi.auth.login') }}" autocomplete='off' >
                        {!! csrf_field() !!}

                        <div class="input-group mb-3">
                            <input type="text" class="form-control {{ $errors->has($username) ? 'is-invalid' : '' }}" name="{{ $username }}" value="{{ old($username) }}" required autofocus />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>

                            @if ($errors->has($username))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first($username) }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="input-group mb-3">
                            <input autocomplete='off' id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>

                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">
                                        {{ trans('cesi::core.remember_me') }}
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @yield('before_scripts')
        @stack('before_scripts')

        @include('cesi::inc.scripts')

        @yield('after_scripts')
        @stack('after_scripts')
    </body>
</html>