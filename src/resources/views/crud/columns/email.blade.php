{{-- email link --}}
@php
    $value = data_get($entry, $column['name']);
@endphp

<span><a href="mailto:{{ $entry->{$column['name']} }}">{{ str_limit(strip_tags($value), array_key_exists('limit', $column) ? $column['limit'] : 254, "[...]") }}</a></span>