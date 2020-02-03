<a href="#" id="CrudTopSendTest" class="btn btn-warning"><i class="fas fa-envelope"></i>&nbsp;{{ trans('cesi::core.emailtmpl.actions.sendtest')}}</a>

@push('before_scripts')
    <div id="ModalForm_sendtest" role="dialog" tabindex="-1" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('cesi::core.emailtmpl.actions.sendtest')}}</h4>
                    <button type="button" class="close novalidate" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="frm_sendtest" name="frm_sendtest" class="form-horizontal" novalidate="">
                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-form-label">Destinatario:</label>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                <input class="form-control" name="to_email" placeholder="email" value="" type="email">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">{{ trans('cesi::core.crud.cancel') }}</button>
                            <button type="submit" class="btn btn-success" id="btn_sendtest">{{ trans('cesi::core.crud.send') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

{{--
var ids = $.map(jQuery('#crudTable').DataTable().rows('.selected').data(), function (item) {
                        return item[0]
                    });
                    console.log(ids);
--}}

@push('after_scripts')
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery("#CrudTopSendTest").click(function(event) {
                event.preventDefault();

                var selected = jQuery('#crudTable').DataTable().row( { selected: true } );
                if ( selected.any() ) {
                    var form = jQuery('#frm_sendtest');

                    var tmp = jQuery('<input>', {
                        'name': 'idtmpl',
                        'value': selected.data().id,
                        'type': 'hidden',
                    });

                    form.append(tmp);

                    jQuery('#ModalForm_sendtest').modal('show');
                } else {
                    Swal.fire({
                        title: "Seleccion",
                        text: "Debe seleccionar 1 registro",
                        type: "warning",
                    });
                }
            });

            jQuery("#frm_sendtest").submit(function (e) {
                e.preventDefault();
                console.log(jQuery(this).serialize());
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.core.emailtmpl.sendtest') }}",
                    dataType: 'json',

                    headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') },
                    data: jQuery(this).serialize(),

                    statusCode: {
                        500: function() {
                            $.notify({
                                // options
                                icon: 'fa fa-exclamation-triangle',
                                title: '<strong>Error 500</strong>: <br>',
                                message: 'An error occurred while sending data.'
                            },{
                                // settings
                                type: "danger",
                                allow_dismiss: true,
                                newest_on_top: true,
                                showProgressbar: false,
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 9999,
                                delay: 5000,
                                timer: 1000,
                                mouse_over: "pause",
                                animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                                }
                            });
                        }
                    },

                    success: function (data) {
                        console.log(data);
                        jQuery('#ModalForm_sendtest').modal('hide');

                        new PNotify({
                            type: data.status,
                            title: data.title,
                            text: data.msg
                        });

//                    var $option = jQuery("<option selected></option>").val(data.record.id).text(data.record.name);
//                    $select_domain.append($option).trigger('change');
                    },

                    error: function (data) {
                        $errors = data.responseJSON.errors;

                        for (var control in $errors) {
                            var input = jQuery("#frm_sendtest :input[name='" + control + "']");
                            input.parent().parent().addClass('has-error');
                            var hlp = input.parent().find('.help-block');
                            if (hlp.length <= 0){
                                input.parent().append('<span class="help-block"></span>');
                            } else {
                                hlp.html('');
                            }
                            input.parent().find('.help-block').append('<strong>' + $errors[control] + '</strong>');
                        }
                    }
                });
            });

        });
    </script>
@endpush
