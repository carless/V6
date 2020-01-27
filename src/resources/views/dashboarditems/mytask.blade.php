<?php
?>
<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">{{$item->titulo}}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0" style="display: block;">
        <table id="DTTableMyTask" class="table table-condensed table-hover m-0">
            <thead>
                <tr>
                    <th>{{ trans('cesi::core.task.fields.name') }}</th>
                    <th style="width: 150px;">{{ trans('cesi::core.task.fields.status') }}</th>
                    <th style="width: 120px;">{{ trans('cesi::core.task.fields.fecha_inicio') }}</th>
                    <th style="width: 120px;">{{ trans('cesi::core.crud.actions') }}</th>
                </tr>
            </thead>
        </table>
        <!-- /.table-responsive -->
    </div>
</div>

@section('after_scripts')
    <script src="{{ asset('vendor/cesi/core/plugins/datatables/datatables.min.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var oTableMyTask = $('#DTTableMyTask').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: false,
                select: 'single',
                ajax: {
                    url: '{!! route( 'admin.core.task.getdata') !!}',
                    dataType: 'json',
                    type: 'POST',
                    data: function (d) {
                        d.token = '{{csrf_token()}}';
                        d.filter = {};
                        d.filter['fltUser'] = '{{Auth::User()->id}}';
                        d.filter['fltStatus'] = 1;
                        d.filter['fltPrioridad'] = 0;
                        d.order_column = 'fecha_inicio';
                        d.order_dir = 'desc';
                    }
                },
                scrollY: '300px',
                scroller: true,
                order: [],
                columns: [
                    {data: 'name', name: 'name', orderable: false, searchable: false},
                    {data: 'status_id', name: 'status_id', orderable: false, searchable: false, width: '150px'},
                    {data: 'fecha_inicio', name: 'fecha_inicio', orderable: false, searchable: false, width: '120px'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '120px'}
                ],
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
                    "<'row card-footer'<'col-sm-5'i><'col-sm-7'p>>"
            });

            oTableMyTask.on('draw', function () {
                jQuery(".loader").fadeOut("slow");
            });
        });
    </script>
@endsection
