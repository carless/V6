@php
	// if not otherwise specified, the hidden input should take up no space in the form
    if (!isset($field['wrapperAttributes']) || !isset($field['wrapperAttributes']['class']))
    {
        $field['wrapperAttributes']['class'] = "hidden";
    }
@endphp

<!-- hidden input -->
<input type="hidden" name="{{ $field['name'] }}"
	   value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
		@include('cesi::inc.field_attributes')
  	/>