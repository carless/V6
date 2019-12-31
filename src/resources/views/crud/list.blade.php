@extends('cesi::layout')

@section('header')
    <div class="content-header">
        @if (!empty($heading))
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h1>
                            <span class="text-capitalize">{!! $heading !!}</span>
                            <small>{!! $subheading !!}</small>
                        </h1>
                    </div><!-- /.col -->
                    <div class="col-6">
                        <div class="box-actions float-right">
                            @foreach ($buttons_top as $button)
                                @if ($button->type == 'model_function')
                                    {!! $model->{$button->content}(); !!}
                                @else
                                    @include($button->content, ['button' => $button])
                                @endif
                            @endforeach
                        </div>
                    </div><!-- /.col -->
                </div>
            </div>
        @endif
    </div>
@endsection

<?php
$_search    = trim(Request::input('buscar', ''));
?>

@section('content')
    <div class="row">
        <div class="{{ $contentClass }}">
            <!-- Default box -->
            <div class="card card-default">
                <div class="card-header" style="background-color: transparent!important;">
                    <form method="POST" id="search-form" class="form-inline mt-2" role="form" style="display: block;overflow: hidden;width: 100%;">
                        <div class="float-left">
                            <label for="filter_fltStatus" class="label_filter">{{trans('cesi::core.crud.search_placeholder')}}</label>
                            <div class="input-group margin-r-5" style="width: 250px;">
                                <input type="text" name="buscar" class="form-control" value="{{ $_search }}" placeholder="{{trans('cesi::core.crud.search_placeholder')}}" />
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                        <div id="filterContainer" class="box-header box-filtros float-left">
                            @foreach ($filtros as $filtro)
                                @include($filtro->view)
                            @endforeach
                        </div>

                        <div class="card-tools float-right">

                        </div>
                    </form>
                </div>
                

                <div class="card-body p-0">
                    <table id="crudTable" class="table table-condensed table-hover table-bordered" style="margin-top: 0px !important;">
                        <thead>
                            <tr>
                                {{-- Table columns --}}
                                @foreach ($columns as $column)
                                    <th>{!! $column['label'] !!}</th>
                                @endforeach

                                {{-- @if ( $buttons->where('stack', 'line')->count() ) --}}
                                    <th>{{ trans('cesi::core.crud.actions') }}</th>
                                {{-- @endif --}}
                            </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_styles')
    <!-- DATA TABLES -->
    <link rel="stylesheet" href="{{ asset('vendor/cesi/core/plugins/datatables/datatables.min.css') }}">

    <!-- CRUD LIST CONTENT - crud_list_styles stack -->
    @stack('crud_list_styles')
@endsection

@push('before_scripts')
    <div id="edit-item" role="dialog" tabindex="-1" class="modal fade">
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
                    <button type="button" class="btn btn-success" id="btn_save_edit">{{ trans('cesi::core.crud.save') }}</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@section('after_scripts')

    <script src="{{ asset('vendor/cesi/core/plugins/datatables/datatables.min.js') }}"></script>
    {{-- @include('cesi::inc.datatables_logic') --}}

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var oTable = $('#crudTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: false,
                select: 'single',
                ajax:{
                    url: '{!! route( $routerAlias . '.getdata') !!}',
                    dataType: 'json',
                    type: 'POST',
                    data: function (d) {
                        d.token = '{{csrf_token()}}';
                        d.buscar = jQuery('input[name=buscar]').val();
                        <?php
                        if (count($filtros) > 0) {
                            print "d.filter = {};\n";
                            foreach($filtros as $filtro) {
                                print "d.filter['" . $filtro->name ."'] = jQuery('#filter_" . $filtro->name. "').val();\n";
                            }
                        }
                        ?>
                    }
                },
                scrollY: '59vh',
                scroller: true,
                columns: [
                        <?php
                        // if($showCheckAll) {
                        //    print "{data: 'check', name: 'check', orderable: false, searchable: false},\n";
                        // }
                        foreach ($columns as $column) {
                            $js = "{data: '" . $column['key'] . "'";
                            $js .= ", name: '" . $column['name'] . "'";
                            if (isset($column['width'])) {
                                $js .= ", width: '" . $column['width'] . "'";
                            }

                            if (isset($column['orderable'])) {
                                if ($column['orderable']=='1') {
                                    $js .= ", orderable: true";
                                } else {
                                    $js .= ", orderable: false";
                                }
                            }

                            if (isset($column['searchable'])) {
                                if ($column['searchable']=='1') {
                                    $js .= ", searchable: true";
                                } else {
                                    $js .= ", searchable: false";
                                }
                                // $js .= ", searchable: '" . $column['searchable'] . "'";
                            }

                            if (isset($column['visible'])) {
                                if ($column['visible']=='1') {
                                    $js .= ", visible: true";
                                } else {
                                    $js .= ", visible: false";
                                }
                                // $js .= ", visible: '" . $column['visible'] . "'";
                            }
                            $js .= "},\n";
                            print $js;
                        }
                        ?>
                    {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '120px'}
                ],
                <?php
                        // $orderColumn = $crud->getColumnNumericIndex($crud->getDefaultOrderColumn());
                        if ($columnOrderNum>=0) {
                            echo "order: [[" . $columnOrderNum . ", '" . $columnOrderDire . "']],\n";
                        }
                ?>
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

            oTable.on('draw', function () {
                jQuery(".loader").fadeOut("slow");
//                console.log( 'Redraw occurred at: '+new Date().getTime() );
            });

            jQuery('#dtbtnrefresh').on("click touchstart", function (e) {
                jQuery(".loader").fadeIn("slow");
                oTable.draw(false);
                // oTable.ajax.reload();
                e.preventDefault();
            });

            jQuery('#search-form').on('submit', function(e) {
                jQuery(".loader").fadeOut("slow");
                oTable.draw();
                e.preventDefault();
            });

            jQuery('#edit-item').on('hidden.bs.modal', function (e) {
                jQuery(".loader").fadeIn("slow");
                e.preventDefault();
                console.log('Se ha cerrado la ventana modal');
                oTable.draw(false);
            });

            // override ajax error message
            $.fn.dataTable.ext.errMode = 'none';
            oTable.on('error.dt', function(e, settings, techNote, message) {
                new PNotify({
                    type: "error",
                    title: "{{ trans('cesi::core.crud.ajax_error_title') }}",
                    text: "{{ trans('cesi::core.crud.ajax_error_text') }}"
                });
            });

            jQuery('#btn_save_edit').on("click touchstart", function (e) {
                e.preventDefault();
                var modalShowItem = jQuery('#edit-item');

                var modalBody = modalShowItem.find('.modal-body');
                var myIframe = modalBody.find('iframe');
                var myForm = myIframe.contents().find('#mainform');
                myForm.submit();
            });

            oTable.on("click touchstart", ".edt-btn-modal", function (e) {
                e.preventDefault();

                var myiframe = jQuery('<iframe>', {
                    name: 'edit-item-modal',
                    src: jQuery(this).attr('data-route-value'),
                    style: 'border:none;',
                    width: '100%',
                    height: jQuery(window).height() * 0.7
                });

                var modalShowItem = jQuery('#edit-item');
                var modalBody = modalShowItem.find('.modal-body');
                modalBody.find('iframe').remove();
                modalBody.append(myiframe);

                modalShowItem.modal('show');
            });

            // ----------------------------------------------
            // Delete confirmation modal
            // ----------------------------------------------
            oTable.on("click touchstart", ".delete-btn", function (e) {
                e.preventDefault();
                console.log('delete id:' + jQuery(this).attr("value"));
                var urlDelete = jQuery(this).attr("value");
                var tr_cancel = (jQuery(this).attr('data-trans-button-cancel')) ? jQuery(this).attr('data-trans-button-cancel') : "{{trans('cesi::core.confirmation_no')}}";
                var tr_confirm= (jQuery(this).attr('data-trans-button-confirm')) ? jQuery(this).attr('data-trans-button-confirm') : "{{trans('cesi::core.confirmation_yes')}}";
                var tr_title  = (jQuery(this).attr('data-trans-title')) ? jQuery(this).attr('data-trans-title') : "{{trans('cesi::core.delete_title_confirm')}}";
                var tr_text   = (jQuery(this).attr('data-trans-text')) ? jQuery(this).attr('data-trans-text') : "{{trans('cesi::core.delete_selected')}}";


                Swal.fire({
                        title: tr_title,
                        text: tr_text,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: tr_confirm,
                        cancelButtonText: tr_cancel
                    }).then((result) => {
                        if (result.value) {
                            jQuery.ajax({
                                url: urlDelete,
                                type: 'POST',
                                data: {
                                    '_method' : 'DELETE',
                                    '_token' : '{{ csrf_token()}}',
                                    '_ismodal' : '1'
                                    },
                                success: function(results){
                                    if (results.success === true) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                        );
                                    } else {
                                        Swal.fire(
                                            'Error!',
                                            results.message,
                                            'error'
                                        );
                                    }
                                    oTable.draw();
                                },
                                error : function(data){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Opps...',
                                        text : 'Something went wrong!'
                                    })
                                }
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            });
        });

        window.closeEditModal = function(){
            jQuery('#edit-item').modal('hide');
        };
    </script>

    @stack('crud_list_scripts')
@endsection