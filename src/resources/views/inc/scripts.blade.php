<!-- jQuery 3.4.1 -->
<script src="{{ asset('vendor/cesi/core/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4.3.1 -->
<script src="{{ asset('vendor/cesi/core/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>

<script src="{{ asset('vendor/cesi/core/plugins/select2/js/select2.full.min.js') }}" ></script>

<script src="{{ asset('vendor/cesi/core/plugins/sweetalert2/sweetalert2.min.js') }}" ></script>

<script src="{{ asset('vendor/cesi/core/js/cesitheme.min.js') }}"></script>

<!-- page script -->
<script type="text/javascript">
    // To make Pace works on Ajax calls
    //$(document).ajaxStart(function() { Pace.restart(); });

    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>