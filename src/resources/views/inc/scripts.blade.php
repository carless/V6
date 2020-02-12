<!-- jQuery 3.4.1 -->
<script src="{{ asset('vendor/cesi/core/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4.3.1 -->
<script src="{{ asset('vendor/cesi/core/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>

<script src="{{ asset('vendor/cesi/core/plugins/select2/js/select2.full.min.js') }}" ></script>
<script src="{{ asset('vendor/cesi/core/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}" ></script>
<script src="{{ asset('vendor/cesi/core/plugins/inputmask/dist/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('vendor/cesi/core/plugins/inputmask/dist/bindings/inputmask.binding.js') }}"></script>
<script src="{{ asset('vendor/cesi/core/plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendor/cesi/core/plugins/datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>

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

        /* Store sidebar state */
        jQuery('[data-widget="pushmenu"]').click(function(event) {
            event.preventDefault();
            if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                console.log('sidebar-toggle-collapsed 0');
                sessionStorage.setItem('sidebar-toggle-collapsed', '');
            } else {
                console.log('sidebar-toggle-collapsed 1');
                sessionStorage.setItem('sidebar-toggle-collapsed', '1');
            }
        });

        jQuery('.date').datepicker({
            format: "dd-mm-yyyy",
            weekStart: 1,
            language: "es",
            todayBtn: true,
            clearBtn: true,
            todayHighlight: true,
            autoclose: true
        });

        jQuery('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            weekStart: 1,
            language: "es",
            todayBtn: true,
            clearBtn: true,
            todayHighlight: true,
            autoclose: true
        });

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

        jQuery('.code6').each(function(e) {
            jQuery(this).val(padLeft(jQuery(this).val(), 6));
        });
        jQuery('.code6').blur(function(e){
            jQuery(this).val(padLeft(jQuery(this).val(), 6));
        });

        jQuery('.code6').keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 ||
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });

        @stack('jquery_document_ready')
    });

    function padLeft(value, length) {
        return ('0'.repeat(length) + value).slice(-length);
    }
</script>
{{--
    /*
    function padLeft(nr, n, str){
        return Array(n-String(nr).length+1).join(str||'0')+nr;
    }
    */
--}}
