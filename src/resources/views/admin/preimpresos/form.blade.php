<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="card card-primary">
                <div class="card-body form-horizontal">
                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name' , trans('cesi::core.preimpresos.fields.name'). '* :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('name', old('name', $entry->name), ['class' => 'form-control', 'autofocus', 'placeholder' => '', 'required' => 'required',]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('slug') ? ' has-error' : '' }}">
                        {{ Form::label('slug' , trans('cesi::core.preimpresos.fields.slug'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('slug', old('slug', $entry->slug), ['class' => 'form-control', 'placeholder' => '', ]) }}
                            @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('archivo') ? ' has-error' : '' }}">
                        {{ Form::label('archivo' , trans('cesi::core.preimpresos.fields.archivo'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="filepdf" id="filepdf">
                                    <label class="custom-file-label" for="filepdf">{{trans('cesi::core.crud.select_file')}}</label>
                                </div>
                            </div>

                            {{ Form::text('archivo', old('slug', $entry->archivo), ['class' => 'form-control', 'readonly' => 'readonly']) }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="preimp-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="preimp-tabs-ajustes-tab" data-toggle="pill" href="#preimp-tabs-ajustes" role="tab" aria-controls="preimp-tabs-ajustes" aria-selected="true">{{trans('cesi::core.preimpresos.tabs.ajustes')}}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content" id="preimp-tabs-tabContent">
                                <div class="tab-pane fade show active" id="preimp-tabs-ajustes" role="tabpanel" aria-labelledby="preimp-tabs-ajustes-tab">
                                    @include('cesi::core.admin.preimpresos.form_ajustes')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group row">
                        {{ Form::label('status' , trans('cesi::core.preimpresos.fields.status') . ' :', ['class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-12 col-form-label text-right']) }}
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 ">
                            @include('cesi::core.crud.fields.checkbox', [
                                    'field' => [
                                        'name' => 'activo',
                                        'value' => $entry->activo,
                                        'description' => trans('cesi::core.preimpresos.fields.activo'),
                                        'style' => 'primary',
                                        ],
                                    ])
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('tipo') ? ' has-error' : '' }}">
                        {{ Form::label('tipo' , trans('cesi::core.preimpresos.fields.tipo'). ' :', ['class' => 'col-lg-5 col-md-5 col-sm-5 col-xs-12 col-form-label text-right']) }}

                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            {{ Form::select('tipo', \Cesi\Core\app\App\Helpers\CesiCoreHelper::getTiposPreImpresos(), old('tipo', $entry->tipo), ['class' => 'form-control select2bs4', 'data-minimum-results-for-search' => 'Infinity']) }}
                            @if ($errors->has('tipo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tipo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @include('cesi::core.admin.info_horizontal')
                </div>
            </div>
        </div>
    </div>
</div>

@push('after_scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            jQuery("input.numero").inputmask("integer", {
                autoUnmask: true,
                min: 0,
                max: 999,
                removeMaskOnSubmit: true,
                clearMaskOnLostFocus: true
            });
        });
    </script>
@endpush

