<?php
$permissionNew = $permissionName . '.create';
?>
@if(cesi_user()->can($permissionNew))
    <a id="CrudTopNew" href="#" data-route-value="{!! route( $routerAlias . '.createmodal') !!}" class="btn btn-success">
        <i class="fa fa-plus"></i> {{ trans('cesi::core.crud.new') }}
    </a>
@endif

