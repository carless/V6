<?php
$permissionNew = $permissionName . '.create';
?>
@if(cesi_user()->can($permissionNew))
    <a href="{!! route( $routerAlias . '.create') !!}" class="btn btn-success">
        <i class="fa fa-plus"></i> {{ trans('cesi::core.crud.new') }}
    </a>
@endif
