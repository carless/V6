<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('cesi::inc.head')
    </head>

    <body class="ajaxpanel">
        @yield('header')

        @yield('content')


        @yield('before_scripts')
        @stack('before_scripts')

        @include('cesi::inc.scripts')
        @include('cesi::inc.alerts')

        @yield('after_scripts')
        @stack('after_scripts')

        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery.fn.select2.defaults.set("theme", "bootstrap4");
                @stack('jquery_document_ready')
            });
        </script>

        <!-- JavaScripts -->
    </body>
</html>