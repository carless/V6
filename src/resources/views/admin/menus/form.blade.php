<?php
$list_tipoMenus = \Cesi\Core\app\App\Helpers\CesiCoreHelper::getTiposMenus();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="card card-primary">
                <div class="card-body form-horizontal">

                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name' , trans('cesi::core.menus.fields.name') . ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('name', old('name', $entry->name), ['class' => 'form-control', 'autofocus', 'placeholder' => '', 'required' => 'required']) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('icon') ? ' has-error' : '' }}">
                        {{ Form::label('icon' , trans('cesi::core.menus.fields.icon') . ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('icon', old('icon', $entry->icon), ['class' => 'form-control', 'placeholder' => '']) }}
                            @if ($errors->has('icon'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('icon') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('claveiva') ? ' has-error' : '' }}">
                        {{ Form::label('type' , trans('cesi::core.menus.fields.type'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::select('type', $list_tipoMenus, old('type', $entry->type), ['class' => 'select2bs4 form-control', 'id' => 'type', 'style' => 'width:100%;', 'data-minimum-results-for-search' => 'Infinity']) }}

                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('link') ? ' has-error' : '' }}">
                        {{ Form::label('link' , trans('cesi::core.menus.fields.link') . ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('link', old('link', $entry->link), ['class' => 'form-control', 'placeholder' => '']) }}
                            @if ($errors->has('link'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('link') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                        {{ Form::label('parent_id' , trans('cesi::core.menus.fields.parent_id'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            @include('cesi::core.admin.menus.select2', [
                                'field' => [
                                    'name' => 'parent_id',
                                    'value' => $entry->parent_id
                                    ],
                                ])

                            @if ($errors->has('parent_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parent_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="card card-primary">
                <div class="card-body">
                    @include('cesi::core.admin.info_horizontal')
                </div>
            </div>
        </div>
    </div>
</div>

@push('jquery_document_ready')
    //Initialize Select2 Elements
    jQuery('.select2bs4').select2({
        theme: 'bootstrap4'
    })
@endpush