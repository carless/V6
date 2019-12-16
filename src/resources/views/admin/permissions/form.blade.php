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

                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="form-group row">
                        {{ Form::label('roles' , trans('cesi::core.permissionmanager.roles_assigned') . ' :', ['class' => 'col-md-5 col-sm-5 col-xs-12 col-form-label text-right']) }}

                        <div class="col-md-7 col-sm-7 col-xs-12">
                            @foreach ($roles as $role)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->id }}" @if($entry->roles->contains($role)) checked @endif >
                                    <label for="role_{{ $role->id }}" class="custom-control-label">{{ $role->name }}</label>
                                </div>
                                {{-- $permiso->name --}}
                            @endforeach
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
