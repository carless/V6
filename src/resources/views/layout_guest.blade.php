<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('cesi::inc.head')
</head>
<body class="hold-transition {{ config('cesi.core.skin') }} ">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper no-margin no-padding">

            <!-- Content Header (Page header) -->
        @yield('header')

        <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer m-l-0 text-sm">
            @include('cesi::inc.footer')
        </footer>
    </div>
    <!-- ./wrapper -->


    @yield('before_scripts')
    @stack('before_scripts')

    @include('cesi::inc.scripts')
    @include('cesi::inc.alerts')

    @yield('after_scripts')
    @stack('after_scripts')

<!-- JavaScripts -->
{{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>
</html>
