<?php
$model_dashboards = new Cesi\Core\app\Models\CoreDashboard();

$dflt_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : false ));
$dflt_display = trans('mcesi::core.dashboard.select');
$item = null;

if($dflt_value) {
    $item = $model_dashboards->find($dflt_value);
    if ($item) {
        $dflt_display = $item->name;
    }
}
?>

<select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control">
    @if($dflt_value)
        <option value="{{$dflt_value}}" selected >{{$dflt_display}}</option>
    @endif
</select>

@push('jquery_document_ready')
    var $select_dashboard = jQuery('#{{ $field['name'] }}').select2({
        placeholder: "{{ trans('cesi::core.dashboard.select') }}",
        triggerChange: true,
        allowClear: true,
        ajax: {
            url: '{{ route('admin.core.coredashboard.getdataajax') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    buscar: $.trim(params.term),
                    length: 150
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
@endpush
