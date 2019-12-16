<!-- text input -->
<div @include('cesi::inc.field_wrapper_attributes') >
    <label class="col-2 col-form-label">{!! $field['label'] !!}</label>

    <div class="col-10">
        @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <div class="input-group-addon">{!! $field['prefix'] !!}</div> @endif
            <input type="text" name="{{ $field['name'] }}"
                   value="{{ old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '' }}"
                    @include('cesi::inc.field_attributes')
            />
        @if(isset($field['suffix'])) <div class="input-group-addon">{!! $field['suffix'] !!}</div> @endif
        @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif
    </div>
</div>