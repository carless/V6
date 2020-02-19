<?php
$current_value = old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '';
$checked_value = '';
if ($current_value==1) {
    $checked_value = 'checked="checked"';
}
?>
<div class="icheck-{{isset($field['style']) ? $field['style'] : 'default'}}">
    <input type="checkbox" name="{{ $field['name'] }}" value="1" id="id_{{ $field['name'] }}" {{$checked_value}} />
    <label for="id_{{ $field['name'] }}">
        @if (isset($field['description']))
            {{ $field['description'] }}
        @endif
    </label>
</div>
