<div id="saveActions" class="text-center mb-2">
    <input type="hidden" name="save_action" value="{{-- $saveAction['active']['value'] --}}">

    <a href="{{ $crud->hasAccess('list') ? url($crud->route) : url()->previous() }}" class="btn btn-sm btn-danger margin-r-5 margin-l-5">
        <i class="fa fa-ban"></i> <span>{{ trans('cesi::core.crud.cancel') }}</span>
    </a>
</div>