<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('cesi::inc.head')
    </head>

    <body class="hold-transition {{ config('cesi.core.skin') }} sidebar-mini">
        <script type="text/javascript">
            /* Recover sidebar state */
            (function () {
                if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                    var body = document.getElementsByTagName('body')[0];
                    body.className = body.className + ' sidebar-collapse';
                }
            })();
        </script>
        <!-- Site wrapper -->
        <div class="wrapper">

            @include('cesi::inc.main_navbar')

            @include('cesi::inc.main_sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @yield('header')

                <!-- Main content -->
                <section class="content">

                    @yield('content')

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer text-sm clearfix">
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
    </body>
</html>