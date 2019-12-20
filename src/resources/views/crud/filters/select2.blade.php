<div class="filtro filtro_select filtro_{{$filtro->name}}">
    <label for="filter_{{$filtro->name}}" class="label_filter">{{$filtro->label}}</label>
    <div class="clearfix"></div>
    <?php
    // \Cesi\Core\Helpers\CesiHelper::wdd($filtro); 
    // model
    // displayfield
    // placeholder

    $item = null;
    $dflt_value     = $filtro->currentValue;
    $dflt_display   = "- Todos -";

//    if (isset($filtro->currentValue) && !empty($filtro->currentValue) && !is_null($filtro->currentValue)) {
//        $dflt_value = $filtro->currentValue;
//    }

    if (isset($filtro->placeholder) && !empty($filtro->placeholder)) {
        $dflt_display = $filtro->placeholder;
    }

    if (isset($filtro->options['model'])) {
        $entity = new $filtro->options['model'];
        $entity_key_name = $entity->getKeyName();
        if ($dflt_value) {
            $item = $entity->find($dflt_value);
            if (isset($filtro->options['displayfield'])) {
                $dflt_display = $item->{$filtro->options['displayfield']};
            } else {
                $dflt_display = $item->name;
            }
        }
    }

    ?>
    <select id="filter_{{$filtro->name}}" name="filter[{{$filtro->name}}]" 
        class="form-control smtfilter select2" 
        style="{{ isset($filtro->options['style']) ? $filtro->options['style'] : 'width: 100%;'}}" 
        onchange="jQuery('#search-form').submit();">';
        <option value='{{ $dflt_value }}' {{ $dflt_value ? ' selected' : ''}}>{{$dflt_display}}</option>
        @if (isset($filtro->options['datos']))
            @foreach ($filtro->options['datos'] as $key => $value)
                <option value="{{$key}}" {{ $key == $filtro->currentValue ? ' selected' : ''}}>{{$value}}</option>
            @endforeach 
        @endif
    </select>
</div>

@push('jquery_document_ready')
    var $select_{{ $filtro->name }} = jQuery('#filter_{{ $filtro->name }}').select2({
        placeholder: "{{$filtro->placeholder}}",
        triggerChange: true,
        allowClear: true,
        @if (isset($filtro->options['ajax']))
            ajax: {
                url: '{{$filtro->options['ajax']}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        buscar: $.trim(params.term),
                        length: 10
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        @endif
    });
@endpush