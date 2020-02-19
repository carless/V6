<?php
$model_preimpresos = new \Cesi\Core\app\Models\CorePreimpresos();

$dflt_value = old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : false ));
$dflt_display = trans('cesi::core.preimpresos.select');
$item = null;

if($dflt_value) {
    $item = $model_preimpresos->find($dflt_value);
    if ($item) {
        $dflt_display = $item->name;
    }
}

$filtro_tipo = '0';
if (isset($field['filtro_tipo'])) {
    $filtro_tipo = $field['filtro_tipo'];
}
// filter[flttipo]	= 1
/*
                        if (count($filtros) > 0) {
                            print "d.filter = {};\n";
                            foreach($filtros as $filtro) {
                                print "d.filter['" . $filtro->name ."'] = jQuery('#filter_" . $filtro->name. "').val();\n";
                            }
                        }
*/

?>

<select name="{{ $field['name'] }}" id="{{ $field['name'] }}" class="form-control">
    @if($dflt_value)
        <option value="{{$dflt_value}}" selected >{{$dflt_display}}</option>
    @endif
</select>

@push('jquery_document_ready')
    var $select_preimpresos = jQuery('#{{ $field['name'] }}').select2({
        placeholder: "{{ trans('cesi::core.preimpresos.select') }}",
        triggerChange: true,
        allowClear: true,
        ajax: {
            url: '{{ route('admin.core.preimpresos.getdataajax') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    buscar: $.trim(params.term),
                    length: 150,
                    filter_tipo: '{{$filtro_tipo}}'
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
