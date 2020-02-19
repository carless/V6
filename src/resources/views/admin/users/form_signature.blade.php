<?php
?>
<div class="form-group row {{ $errors->has('signature') ? ' has-error' : '' }}">
    <div class="col-12">
        @include('cesi::core.crud.fields.editorhtml', [ 'field' => ['name' => 'signature', 'value' => $entry->signature]])

        @if ($errors->has('signature'))
            <span class="help-block">
                <strong>{{ $errors->first('signature') }}</strong>
            </span>
        @endif
    </div>
</div>
