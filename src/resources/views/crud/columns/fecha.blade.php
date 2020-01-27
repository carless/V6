@if ($entry->{$column['name']})
    {{ Carbon\Carbon::parse($entry->{$column['name']})->format('d-m-Y') }}
@endif
