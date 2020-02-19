<?php
$list_papel = [
    'A5' => 'A5', // = (  148 x 210  ) mm  = (  5.83 x 8.27  ) in
    'A4' => 'A4', // = (  210 x 297  ) mm  = (  8.27 x 11.69 ) in
    'A3' => 'A3', // = (  297 x 420  ) mm  = ( 11.69 x 16.54 ) in
];

$list_orientation = ['P' => 'Vertical', 'L' => 'Horizontal'];

?>
<div class="form-group row {{ $errors->has('papel') ? ' has-error' : '' }}">
    {{ Form::label('papel' , trans('cesi::core.preimpresos.fields.papel'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label text-right']) }}

    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
        {{ Form::select('papel', $list_papel, old('papel', $entry->papel), ['class' => 'form-control select2bs4', 'data-minimum-results-for-search' => 'Infinity', 'style' => 'width:140px']) }}
        @if ($errors->has('papel'))
            <span class="help-block">
                <strong>{{ $errors->first('papel') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row {{ $errors->has('orientacion') ? ' has-error' : '' }}">
    {{ Form::label('orientacion' , trans('cesi::core.preimpresos.fields.orientacion'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label text-right']) }}

    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
        {{ Form::select('orientacion', $list_orientation, old('orientacion', $entry->orientacion), ['class' => 'form-control select2bs4', 'data-minimum-results-for-search' => 'Infinity', 'style' => 'width:140px']) }}
        @if ($errors->has('orientacion'))
            <span class="help-block">
                <strong>{{ $errors->first('orientacion') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group row">
    <span>{{trans('cesi::core.preimpresos.textos.margenes')}}</span>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group row {{ $errors->has('margenCab') ? ' has-error' : '' }}">
            {{ Form::label('margenCab' , trans('cesi::core.preimpresos.fields.margenCab'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('margenCab', old('margenCab', $entry->margenCab), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('margenCab'))
                    <span class="help-block">
                        <strong>{{ $errors->first('margenCab') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('margenPie') ? ' has-error' : '' }}">
            {{ Form::label('margenPie' , trans('cesi::core.preimpresos.fields.margenPie'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('margenPie', old('margenPie', $entry->margenPie), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('margenPie'))
                    <span class="help-block">
                        <strong>{{ $errors->first('margenPie') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row {{ $errors->has('margenIzq') ? ' has-error' : '' }}">
            {{ Form::label('margenIzq' , trans('cesi::core.preimpresos.fields.margenIzq'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('margenIzq', old('margenIzq', $entry->margenIzq), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('margenIzq'))
                    <span class="help-block">
                        <strong>{{ $errors->first('margenIzq') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('margenDer') ? ' has-error' : '' }}">
            {{ Form::label('margenDer' , trans('cesi::core.preimpresos.fields.margenDer'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('margenDer', old('margenDer', $entry->margenDer), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('margenDer'))
                    <span class="help-block">
                        <strong>{{ $errors->first('margenDer') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="form-group row">
    <span>{{trans('cesi::core.preimpresos.textos.showcab')}}</span>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group row {{ $errors->has('mostrarCab') ? ' has-error' : '' }}">
            {{ Form::label('mostrarCab' , trans('cesi::core.preimpresos.fields.mostrarCab') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'mostrarCab',
                                                        'value' => $entry->mostrarCab,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        ],
                                                    ])
            </div>
        </div>
    </div>
    <div class="col-6">

    </div>
</div>

<div class="form-group row">
    <span>{{trans('cesi::core.preimpresos.textos.showlogo')}}</span>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group row {{ $errors->has('mostrarLogo') ? ' has-error' : '' }}">
            {{ Form::label('mostrarLogo' , trans('cesi::core.preimpresos.fields.mostrarLogo') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'mostrarLogo',
                                                        'value' => $entry->mostrarLogo,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>
    </div>
    <div class="col-6">

        <div class="form-group row {{ $errors->has('logoPosX') ? ' has-error' : '' }}">
            {{ Form::label('logoPosX' , trans('cesi::core.preimpresos.fields.logoPosX'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('logoPosX', old('logoPosX', $entry->logoPosX), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('logoPosX'))
                    <span class="help-block">
                        <strong>{{ $errors->first('logoPosX') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('logoPosY') ? ' has-error' : '' }}">
            {{ Form::label('logoPosY' , trans('cesi::core.preimpresos.fields.logoPosY'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('logoPosY', old('logoPosY', $entry->logoPosY), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('logoPosY'))
                    <span class="help-block">
                        <strong>{{ $errors->first('logoPosY') }}</strong>
                    </span>
                @endif
            </div>
        </div>

    </div>
</div>

<div class="form-group row">
    <span>{{trans('cesi::core.preimpresos.textos.showtitulo')}}</span>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group row {{ $errors->has('mostrarTitulo') ? ' has-error' : '' }}">
            {{ Form::label('mostrarTitulo' , trans('cesi::core.preimpresos.fields.mostrarTitulo') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'mostrarTitulo',
                                                        'value' => $entry->mostrarTitulo,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>

        <div class="form-group row {{ $errors->has('mostrarSubtitulo') ? ' has-error' : '' }}">
            {{ Form::label('mostrarSubtitulo' , trans('cesi::core.preimpresos.fields.mostrarSubtitulo') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'mostrarSubtitulo',
                                                        'value' => $entry->mostrarSubtitulo,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>
    </div>
    <div class="col-6">

        <div class="form-group row {{ $errors->has('tituloPosX') ? ' has-error' : '' }}">
            {{ Form::label('tituloPosX' , trans('cesi::core.preimpresos.fields.tituloPosX'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('tituloPosX', old('tituloPosX', $entry->tituloPosX), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('tituloPosX'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tituloPosX') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('tituloPosY') ? ' has-error' : '' }}">
            {{ Form::label('tituloPosY' , trans('cesi::core.preimpresos.fields.tituloPosY'). ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                {{ Form::text('tituloPosY', old('tituloPosY', $entry->tituloPosY), ['class' => 'form-control numero', 'placeholder' => '', 'style' => 'width:140px' ]) }}
                @if ($errors->has('tituloPosY'))
                    <span class="help-block">
                        <strong>{{ $errors->first('tituloPosY') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="form-group row">
    <span>{{trans('cesi::core.preimpresos.textos.showpie')}}</span>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-group row {{ $errors->has('mostrarPie') ? ' has-error' : '' }}">
            {{ Form::label('mostrarPie' , trans('cesi::core.preimpresos.fields.mostrarPie') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'mostrarPie',
                                                        'value' => $entry->mostrarPie,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>

        <div class="form-group row {{ $errors->has('pieSeparador') ? ' has-error' : '' }}">
            {{ Form::label('pieSeparador' , trans('cesi::core.preimpresos.fields.pieSeparador') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'pieSeparador',
                                                        'value' => $entry->pieSeparador,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>

    </div>

    <div class="col-6">

        <div class="form-group row {{ $errors->has('pieFecha') ? ' has-error' : '' }}">
            {{ Form::label('pieFecha' , trans('cesi::core.preimpresos.fields.pieFecha') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'pieFecha',
                                                        'value' => $entry->pieFecha,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>

        <div class="form-group row {{ $errors->has('pieHora') ? ' has-error' : '' }}">
            {{ Form::label('pieHora' , trans('cesi::core.preimpresos.fields.pieHora') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'pieHora',
                                                        'value' => $entry->pieHora,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>

        <div class="form-group row {{ $errors->has('pieNumPag') ? ' has-error' : '' }}">
            {{ Form::label('pieNumPag' , trans('cesi::core.preimpresos.fields.pieNumPag') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'pieNumPag',
                                                        'value' => $entry->pieNumPag,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>

        <div class="form-group row {{ $errors->has('pieNumParte') ? ' has-error' : '' }}">
            {{ Form::label('pieNumParte' , trans('cesi::core.preimpresos.fields.pieNumParte') . ' :', ['class' => 'col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label text-right']) }}
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                @include('cesi::core.crud.fields.checkbox', [
                                                    'field' => [
                                                        'name' => 'pieNumParte',
                                                        'value' => $entry->pieNumParte,
                                                        'description' => trans('cesi::core.preimpresos.fields.show'),
                                                        'style' => 'default',
                                                        ],
                                                    ])
            </div>
        </div>
    </div>
</div>
