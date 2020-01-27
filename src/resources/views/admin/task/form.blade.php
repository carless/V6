<?php
$fecha_inicio = old('fecha_inicio', $entry->fecha_inicio);
$fecha_inicio = Carbon\Carbon::parse($fecha_inicio)->format('d-m-Y');

$fecha_final = old('fecha_final', $entry->fecha_final);
if ($fecha_final) {
    $fecha_final = Carbon\Carbon::parse($fecha_final)->format('d-m-Y');
} else {
    $fecha_final = null;
}

$list_prioridad = \Cesi\Core\app\App\Helpers\CesiCoreHelper::getTaskPrioridad();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="card card-primary">
                <div class="card-body form-horizontal">
                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name' , trans('cesi::core.task.fields.name'). '* :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('name', old('name', $entry->name), ['class' => 'form-control', 'autofocus', 'placeholder' => '', 'required' => 'required',]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group row {{ $errors->has('description') ? ' has-error' : '' }}">
                                {{ Form::label('description' , trans('cesi::core.task.fields.description'). ' :', ['class' => 'col-lg-12 col-md-12 col-sm-12 col-xs-12 col-form-label']) }}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    {{ Form::textarea('description', old('description', $entry->description), ['class' => 'form-control', 'placeholder' => '', ]) }}
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group row {{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                                {{ Form::label('fecha_inicio' , trans('cesi::core.task.fields.fecha_inicio'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-group date" data-provide="datepicker">
                                        {{ Form::text('fecha_inicio', $fecha_inicio, ['class' => 'form-control', 'placeholder' => '']) }}
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('fecha_inicio'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_inicio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('fecha_final') ? ' has-error' : '' }}">
                                {{ Form::label('fecha_final' , trans('cesi::core.task.fields.fecha_final'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-group date" data-provide="datepicker">
                                        {{ Form::text('fecha_final', $fecha_final, ['class' => 'form-control', 'placeholder' => '']) }}
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('fecha_final'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('fecha_final') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('user_id') ? ' has-error' : '' }}">
                                {{ Form::label('user_id' , trans('cesi::core.task.fields.asigned_user'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    @include('cesi::core.admin.users.select2', [
                                                    'field' => [
                                                        'name' => 'user_id',
                                                        'value' => $entry->user_id
                                                        ],
                                                    ])
                                    @if ($errors->has('user_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('status_id') ? ' has-error' : '' }}">
                                {{ Form::label('status_id' , trans('cesi::core.task.fields.status'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    @include('cesi::core.admin.taskstatus.select2', [
                                                    'field' => [
                                                        'name' => 'status_id',
                                                        'value' => $entry->status_id
                                                        ],
                                                    ])
                                    @if ($errors->has('status_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('status_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('progreso') ? ' has-error' : '' }}">
                                {{ Form::label('progreso' , trans('cesi::core.task.fields.progreso'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    {{ Form::text('progreso', old('progreso', $entry->progreso), ['class' => 'form-control percent', 'placeholder' => '', ]) }}
                                    @if ($errors->has('progreso'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('progreso') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('prioridad') ? ' has-error' : '' }}">
                                {{ Form::label('prioridad' , trans('cesi::core.task.fields.prioridad'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                                    {{ Form::select('prioridad', $list_prioridad, old('prioridad', $entry->prioridad), ['class' => 'form-control select2bs4', 'data-minimum-results-for-search' => 'Infinity']) }}

                                    @if ($errors->has('prioridad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prioridad') }}</strong>
                                        </span>
                                    @endif
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
        });
    </script>
@endpush
