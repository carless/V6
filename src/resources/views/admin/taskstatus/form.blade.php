<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="card card-primary">
                <div class="card-body form-horizontal">
                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name' , trans('cesi::core.taskstatus.fields.name'). '* :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('name', old('name', $entry->name), ['class' => 'form-control', 'autofocus', 'placeholder' => '', 'required' => 'required',]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('classname') ? ' has-error' : '' }}">
                        {{ Form::label('classname' , trans('cesi::core.taskstatus.fields.classname'). '* :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('classname', old('classname', $entry->classname), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required',]) }}
                            @if ($errors->has('classname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('classname') }}</strong>
                                </span>
                            @endif
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
