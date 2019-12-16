&nbsp;
{{-- @if ($crud->hasAccess('delete')) --}}
    <button type="button" value="{!! route($routerAlias . '.delete', $entry->getKey()) !!}"
            class="btn btn-sm btn-danger delete-btn"
            title="{{ trans('cesi::core.action.delete') }}"
    >
        <i class="fa fa-trash"></i>
    </button>
{{-- @endif --}}