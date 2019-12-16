&nbsp;
<a href="#" class="btn btn-sm btn-info edt-btn-modal" data-route-value="{!! route($routerAlias . '.editmodal', $entry->getKey()) !!}" title="{{trans('cesi::core.crud.edit')}}">
    <i class="fas fa-pencil-alt"></i>
</a>
{{-- @if ($crud->hasAccess('update')) --}}
{{--
    <a href="{{ route( $routerAlias.'.edit', $entry->getKey()) }}"
       class="btn btn-sm btn-info"
       title="{{ trans('cesi::core.crud.edit') }}"
    >
        <i class="fa fa-edit"></i>
    </a>
--}}
{{-- @endif --}}