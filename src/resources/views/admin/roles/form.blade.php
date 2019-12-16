<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="card card-primary">
                <div class="card-body form-horizontal">

                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name' , trans('cesi::core.permissionmanager.name') . ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('name', old('name', $entry->name), ['class' => 'form-control', 'autofocus', 'placeholder' => '', 'required' => 'required']) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('guard_name') ? ' has-error' : '' }}">
                        {{ Form::label('guard_name' , trans('cesi::core.permissionmanager.guard_type') . ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            {{ Form::text('guard_name', old('guard_name', $entry->guard_name), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) }}
                            @if ($errors->has('guard_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('guard_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        {{ Form::label('permisos' , trans('cesi::core.permissionmanager.permission_assigned') . ' :', ['class' => 'col-md-3 col-sm-3 col-xs-12 col-form-label']) }}

                        <div class="col-md-9 col-sm-9 col-xs-12">
                            @foreach ($permisos as $permiso)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="permission_{{ $permiso->id }}" name="permission[]" value="{{ $permiso->id }}" @if($entry->permissions->contains($permiso)) checked @endif >
                                    <label for="permission_{{ $permiso->id }}" class="custom-control-label">{{ $permiso->name }}</label>
                                </div>
                                {{-- $permiso->name --}}
                            @endforeach
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