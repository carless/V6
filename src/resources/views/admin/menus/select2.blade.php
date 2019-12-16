<?php
/**
 * Created by PhpStorm.
 * User: Carless
 * Date: 13/12/2019
 * Time: 10:47
 */

$model_menus = new \Cesi\Core\app\Models\CoreMenu();

$dflt_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : false ));
$dflt_display = trans('cesi::core.menus.select');
$item = null;

if($dflt_value) {
    $item = $model_menus->find($dflt_value);
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
    var $select_menus = jQuery('#{{ $field['name'] }}').select2({
        placeholder: "{{ trans('cesi::core.menus.select') }}",
        triggerChange: true,
        allowClear: true,
        ajax: {
            url: '{{ route('admin.core.menu.getdataajax') }}',
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