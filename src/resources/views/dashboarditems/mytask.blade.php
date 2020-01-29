<?php
$allTaskStatus = \Cesi\Core\app\Models\TaskStatus::all();
?>
<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">{{$item->titulo}}</h3>
        <div class="card-tools">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <select id="filter_fltStatus" name="filter[fltStatus]"
                        class="form-control smtfilter select2bs4"
                        data-minimum-results-for-search="Infinity"
                        onchange="jQuery('#DTTableMyTask').DataTable().draw();"
                        style="width:180px;">
                    <?php
                    $default_status = 1;
                    foreach ($allTaskStatus as $taskStatus) {
                        print '<option value="' . $taskStatus->getKey() . '"';
                        if ($taskStatus->getKey() == $default_status) {
                            print ' selected="selected"';
                        }
                        print '">' . $taskStatus->name . '</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0" style="display: block;">
        <table id="DTTableMyTask" class="table table-condensed table-hover" style="margin-top: 0px !important;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ trans('cesi::core.task.fields.name') }}</th>
                    <th style="width: 150px;">{{ trans('cesi::core.task.fields.status') }}</th>
                    <th>{{ trans('cesi::core.task.fields.prioridad') }}</th>
                    <th>{{ trans('cesi::core.task.fields.asigned_user') }}</th>
                    <th style="width: 120px;">{{ trans('cesi::core.task.fields.fecha_inicio') }}</th>
                    <th style="width: 120px;">{{ trans('cesi::core.task.fields.fecha_final') }}</th>
                    <th style="width: 120px;">{{ trans('cesi::core.crud.actions') }}</th>
                </tr>
            </thead>

            <tbody>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
</div>

@push('before_scripts')
    <div id="edit-task" role="dialog" tabindex="-1" class="modal fade">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('cesi::core.crud.edit')}}</h4>
                    <button type="button" class="close novalidate" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">{{ trans('cesi::core.crud.cancel') }}</button>
                    <button type="button" class="btn btn-success" id="btn_tasksave_edit">{{ trans('cesi::core.crud.save') }}</button>
                </div>
            </div>
        </div>
    </div>
@endpush


@section('after_styles')
    <!-- DATA TABLES -->
    <link rel="stylesheet" href="{{ asset('vendor/cesi/core/plugins/datatables/datatables.min.css') }}">
@endsection

{{--
                        d.filter['fltStatus'] = 1;
                        d.filter['fltPrioridad'] = 0;

--}}
@section('after_scripts')
    <script src="{{ asset('vendor/cesi/core/plugins/datatables/datatables.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            var curr_pos = null;

            var oTableMyTask = $('#DTTableMyTask').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching:  false,
                select:     'single',
                deferRender:true,
                ajax: {
                    url: '{!! route( 'admin.core.mytask.getdata') !!}',
                    dataType: 'json',
                    type: 'POST',
                    data: function (d) {
                        d.token = '{{csrf_token()}}';
                        d.buscar = '';
                        d.filter = {};
                        d.filter['fltPrioridad'] = 0;
                        d.filter['fltStatus'] = jQuery('#filter_fltStatus').val();
                        d.filter['fltUser'] = {{ cesi_auth()->user()->id }};
                    }
                },
                scrollY:  '300px',
                scroller: true,
                scrollCollapse: false,
                columns: [
                    {data: 'id', name: 'id', visible:false},
                    {data: 'name', name: 'name'},
                    {data: 'status_id', name: 'status_id', width: '150px'},
                    {data: 'prioridad', name: 'prioridad', visible:false},
                    {data: 'asignedusername', name: 'asignedusername', visible:false},
                    {data: 'fecha_inicio', name: 'fecha_inicio', width: '120px'},
                    {data: 'fecha_final', name: 'fecha_final', visible:false},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '120px'}
                ],
                order: [[5, 'desc']],
                language: {
                    "sProcessing":     "{{ trans('cesi::core.crud.datatables.Processing') }}",
                    "sLengthMenu":     "{{ trans('cesi::core.crud.datatables.LengthMenu') }}",
                    "sZeroRecords":    "{{ trans('cesi::core.crud.datatables.ZeroRecords') }}",
                    "sEmptyTable":     "{{ trans('cesi::core.crud.datatables.EmptyTable') }}",
                    "sInfo":           "{{ trans('cesi::core.crud.datatables.Info') }}",
                    "sInfoEmpty":      "{{ trans('cesi::core.crud.datatables.InfoEmpty') }}",
                    "sInfoFiltered":   "{{ trans('cesi::core.crud.datatables.InfoFiltered') }}",
                    "sInfoPostFix":    "{{ trans('cesi::core.crud.datatables.InfoPostFix') }}",
                    "sSearch":         "{{ trans('cesi::core.crud.datatables.Search') }}",
                    "sUrl":            "{{ trans('cesi::core.crud.datatables.Url') }}",
                    "sInfoThousands":  "{{ trans('cesi::core.crud.datatables.InfoThousands') }}",
                    "sLoadingRecords": "{{ trans('cesi::core.crud.datatables.LoadingRecords') }}",
                    "oPaginate": {
                        "sFirst":    "{{ trans('cesi::core.crud.datatables.Paginate.First') }}",
                        "sLast":     "{{ trans('cesi::core.crud.datatables.Paginate.Last') }}",
                        "sNext":     "{{ trans('cesi::core.crud.datatables.Paginate.Next') }}",
                        "sPrevious": "{{ trans('cesi::core.crud.datatables.Paginate.Previous') }}"
                    },
                    "oAria": {
                        "sSortAscending":  "{{ trans('cesi::core.crud.datatables.Aria.SortAscending') }}",
                        "sSortDescending": "{{ trans('cesi::core.crud.datatables.Aria.SortDescending') }}"
                    },
                    "buttons": {
                        "copy": "{{ trans('cesi::core.crud.datatables.buttons.copy') }}",
                        "colvis": "{{ trans('cesi::core.crud.datatables.buttons.colvis') }}",
                    }
                },
                dom: "<'row'<'col-sm-12'tr>>" +
                    "<'row card-footer'<'col-sm-10'i><'col-sm-2'p>>"
            });

            oTableMyTask.on('draw', function () {
                jQuery(".loader").fadeOut("slow");

                if (curr_pos != null) {
                    jQuery(oTableMyTask.settings()[0].nScrollBody).scrollTop( curr_pos.top );
                    jQuery(oTableMyTask.settings()[0].nScrollBody).scrollLeft( curr_pos.left );
                    curr_pos = null;
                }
            });

            jQuery('#edit-task').on('hidden.bs.modal', function (e) {
                jQuery(".loader").fadeIn("slow");
                e.preventDefault();
                oTableMyTask.draw(false);
            });

            // override ajax error message
            $.fn.dataTable.ext.errMode = 'none';
            oTableMyTask.on('error.dt', function(e, settings, techNote, message) {
                new PNotify({
                    type: "error",
                    title: "{{ trans('cesi::core.crud.ajax_error_title') }}",
                    text: "{{ trans('cesi::core.crud.ajax_error_text') }}"
                });
            });

            oTableMyTask.on("click touchstart", ".edt-btn-modal", function (e) {
                e.preventDefault();

                curr_pos = {
                    'top': jQuery(oTableMyTask.settings()[0].nScrollBody).scrollTop(),
                    'left': jQuery(oTableMyTask.settings()[0].nScrollBody).scrollLeft()
                };

                var myiframe = jQuery('<iframe>', {
                    name: 'edit-task-modal',
                    src: jQuery(this).attr('data-route-value'),
                    style: 'border:none;',
                    width: '100%',
                    height: jQuery(window).height() * 0.7
                });

                var modalShowItem = jQuery('#edit-task');
                var modalBody = modalShowItem.find('.modal-body');
                modalBody.find('iframe').remove();
                modalBody.append(myiframe);

                modalShowItem.modal('show');
            });

            jQuery('#btn_tasksave_edit').on("click touchstart", function (e) {
                e.preventDefault();

                var modalShowItem = jQuery('#edit-task');

                var modalBody = modalShowItem.find('.modal-body');
                var myIframe = modalBody.find('iframe');
                var myForm = myIframe.contents().find('#mainform');
                myForm.submit();
            });
        });

        window.closeEditModal = function(){
            jQuery('#edit-task').modal('hide');
        };
    </script>
@endsection
