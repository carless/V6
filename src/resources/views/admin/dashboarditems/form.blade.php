<?php
$list_tipos = \Cesi\Core\app\App\Helpers\CesiCoreHelper::getTiposDashboardItems();
$list_areas = \Cesi\Core\app\App\Helpers\CesiCoreHelper::getDashboardAreas();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="card card-primary">
                <div class="card-body form-horizontal">
                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name' , trans('cesi::core.dashboarditems.fields.name') . ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('name', old('name', $entry->name), ['class' => 'form-control', 'autofocus', 'placeholder' => '', 'required' => 'required']) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>                        
                    </div>

                    <div class="form-group row {{ $errors->has('area') ? ' has-error' : '' }}">
                        {{ Form::label('area' , trans('cesi::core.dashboarditems.fields.area'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::select('area', $list_areas, old('area', $entry->area), ['class' => 'select2bs4 form-control', 'id' => 'area', 'style' => 'width:100%;', 'data-minimum-results-for-search' => 'Infinity']) }}

                            @if ($errors->has('area'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('area') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                    

                    <div class="form-group row {{ $errors->has('tipo') ? ' has-error' : '' }}">
                        {{ Form::label('tipo' , trans('cesi::core.dashboarditems.fields.tipo'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::select('tipo', $list_tipos, old('tipo', $entry->tipo), ['class' => 'select2bs4 form-control', 'id' => 'tipo', 'style' => 'width:100%;', 'data-minimum-results-for-search' => 'Infinity']) }}

                            @if ($errors->has('tipo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tipo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-body form-horizontal">
                    <?php

                    $configuraciones = $entry->config;
                    $titulo = '';
                    if (isset($configuraciones->titulo)) {
                        $titulo = $configuraciones->titulo;
                    }

                    $icono = '';
                    if (isset($configuraciones->icono)) {
                        $icono = $configuraciones->icono;
                    }

                    $classe = '';
                    if (isset($configuraciones->classe)) {
                        $classe = $configuraciones->classe;
                    }

                    $link = '';
                    if (isset($configuraciones->link)) {
                        $link = $configuraciones->link;
                    }

                    $sql = '';
                    if (isset($configuraciones->sql)) {
                        $sql = $configuraciones->sql;
                    }

                    ?>
                    <div class="form-group row {{ $errors->has('titulo') ? ' has-error' : '' }}">
                        {{ Form::label('titulo' , trans('cesi::core.dashboarditems.fields.titulo'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('config[titulo]', old('titulo', $titulo), ['class' => 'form-control', 'autofocus', 'placeholder' => '']) }}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('icono') ? ' has-error' : '' }}">
                        {{ Form::label('icono' , trans('cesi::core.dashboarditems.fields.icono'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('config[icono]', old('icono', $icono), ['class' => 'form-control', 'autofocus', 'placeholder' => '']) }}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('classe') ? ' has-error' : '' }}">
                        {{ Form::label('classe' , trans('cesi::core.dashboarditems.fields.classe'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('config[classe]', old('classe', $classe), ['class' => 'form-control', 'autofocus', 'placeholder' => '']) }}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('link') ? ' has-error' : '' }}">
                        {{ Form::label('link' , trans('cesi::core.dashboarditems.fields.link'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('config[link]', old('link', $link), ['class' => 'form-control', 'autofocus', 'placeholder' => '']) }}
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('sql') ? ' has-error' : '' }}">
                        {{ Form::label('sql' , trans('cesi::core.dashboarditems.fields.sql'). ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('config[sql]', old('sql', $sql), ['class' => 'form-control', 'autofocus', 'placeholder' => '']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="card card-primary mb-3">
                <div class="card-body form-horizontal">
                    <div class="form-group row {{ $errors->has('dashboard_id') ? ' has-error' : '' }}">
                        {{ Form::label('dashboard_id' , trans('cesi::core.dashboarditems.fields.dashboard'). ' :', ['class' => 'col-md-5 col-sm-5 col-xs-12 col-form-label']) }}

                        <div class="col-md-7 col-sm-7 col-xs-12">
                            @include('cesi::core.admin.dashboard.select2', [
                                'field' => [
                                    'name' => 'dashboard_id',
                                    'value' => $entry->dashboard_id
                                    ],
                                ])

                            @if ($errors->has('dashboard_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dashboard_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('sorting' , trans('cesi::core.dashboarditems.fields.orden') . ' :', ['class' => 'col-md-5 col-sm-5 col-xs-12 col-form-label']) }}

                        <div class="col-md-7 col-sm-7 col-xs-12">
                            {{ Form::number('sorting', old('sorting', $entry->sorting), ['class' => 'form-control', 'placeholder' => '', 'style' => 'width:80px;']) }}

                            @if ($errors->has('sorting'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sorting') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

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