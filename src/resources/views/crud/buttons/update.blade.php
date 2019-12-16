{{-- @if ($crud->hasAccess('update')) --}}
    <a href="{{ route( $routerAlias.'.edit', $entry->getKey()) }}"
       class="btn btn-sm btn-info"
       title="{{ trans('cesi::core.crud.edit') }}"
    >
        <i class="fa fa-edit"></i>
    </a>
{{-- @endif --}}