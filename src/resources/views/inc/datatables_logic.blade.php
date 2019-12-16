<script src="{{ asset('vendor/cesi/core/plugins/datatables/dataTable.js') }}"></script>

<script>
    var crud = {
        functionsToRunOnDataTablesDrawEvent: [],
        addFunctionToDataTablesDrawEventQueue: function (functionName) {
            if (this.functionsToRunOnDataTablesDrawEvent.indexOf(functionName) == -1) {
                this.functionsToRunOnDataTablesDrawEvent.push(functionName);
            }
        },
        executeFunctionByName: function(str, args) {
            var arr = str.split('.');
            var fn = window[ arr[0] ];

            for (var i = 1; i < arr.length; i++)
            { fn = fn[ arr[i] ]; }
            fn.apply(window, args);
        },
        updateUrl : function (new_url) {
            new_url = new_url.replace('/search', '');
            window.history.pushState({}, '', new_url);
            localStorage.setItem('{{ str_slug($crud->getRoute()) }}_list_url', new_url);
        },

        dataTableConfiguration: {
            responsive: true,
            processing: true,
            serverSide: true,
            searching: false,
            select: true,
            ajax:{
                url: '{!! $crud->route . '/getdata' !!}',
                dataType: 'json',
                type: 'POST',
                data: function (d) {
                    d.token = '{{csrf_token()}}';
                    d.buscar = jQuery('input[name=buscar]').val();
                    <?php
                        /*
                    if (count($filtros) > 0) {
                        print "d.filter = {};\n";
                        foreach($filtros as $filtro) {
                            print "d.filter['" . $filtro->name ."'] = jQuery('#filter_" . $filtro->name. "').val();\n";
                        }
                    }
                        */
                    ?>
                }
            },
            scrollY:        '65vh',
            scrollCollapse: false,
            scroller:       true,
            dom: "<'row'<'col-sm-12'tr>>" +
                "<'row pad-r-l-5 dtfoot'<'col-sm-5'i><'col-sm-7'p>>"
        }
    };
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        crud.table = jQuery("#crudTable").DataTable(crud.dataTableConfiguration);

        // override ajax error message
        $.fn.dataTable.ext.errMode = 'none';
        $('#crudTable').on('error.dt', function(e, settings, techNote, message) {
            new PNotify({
                type: "error",
                title: "{{ trans('cesi::core.crud.ajax_error_title') }}",
                text: "{{ trans('cesi::core.crud.ajax_error_text') }}"
            });
        });

        // make sure AJAX requests include XSRF token
        $.ajaxPrefilter(function(options, originalOptions, xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                return xhr.setRequestHeader('X-XSRF-TOKEN', token);
            }
        });
    });
</script>