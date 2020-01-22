<!-- jQuery 3.4.1 -->
<script src="{{ asset('vendor/cesi/core/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4.3.1 -->
<script src="{{ asset('vendor/cesi/core/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>

<script src="{{ asset('vendor/cesi/core/plugins/select2/js/select2.full.min.js') }}" ></script>
<script src="{{ asset('vendor/cesi/core/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}" ></script>
<script src="{{ asset('vendor/cesi/core/plugins/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('vendor/cesi/core/plugins/inputmask/dist/bindings/inputmask.binding.js') }}"></script>

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

    jQuery(document).ready(function($) {
        jQuery.fn.select2.defaults.set("theme", "bootstrap4");

        jQuery("input.percent").inputmask("percentage", {
            autoUnmask: true,
            digits: 2,
            removeMaskOnSubmit: true,
            clearMaskOnLostFocus: true
        });

        jQuery("input.price").inputmask("currency", {
            autoUnmask: true,
            prefix: '',
            suffix: ' €',
            digits: '2',
            removeMaskOnSubmit: true,
            clearMaskOnLostFocus: true
        });

        jQuery("input.price_c").inputmask("currency", {
            autoUnmask: true,
            prefix: '',
            suffix: ' €',
            digits: '2',
            removeMaskOnSubmit: true,
            clearMaskOnLostFocus: true
        });

        jQuery("input.price_v").inputmask("currency", {
            autoUnmask: true,
            prefix: '',
            suffix: ' €',
            digits: '2',
            removeMaskOnSubmit: true,
            clearMaskOnLostFocus: true
        });

        jQuery("input.numerodia").inputmask("integer", {
            autoUnmask: true,
            min: 0,
            max: 31,
            removeMaskOnSubmit: true,
            clearMaskOnLostFocus: true
        });

        @stack('jquery_document_ready')

    });
</script>
