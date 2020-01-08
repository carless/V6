<?php
$number = '';
try {
    if (!empty($item->sql)) {
        $resultado = DB::Select(DB::raw($item->sql));
        $number = count($resultado);
    }
} catch (\Exception $e) {
    echo 'Error:' . $e->getMessage();
}
?>
<!-- small box -->
<div class="small-box {{$item->classe}}">
    <div class="inner">
        <h3>{{$number}}</h3>
        <p>{{$item->titulo}}</p>
    </div>
    <div class="icon">
        @if(isset($item->icono) && !empty($item->icono))
            <i class="{{$item->icono}}"></i>
        @endif
    </div>
    @if (!empty($item->link))
        <a href="{{ route($item->link) }}" class="small-box-footer">{{ trans('cesi::core.dashboard.readmore') }} <i class="fas fa-arrow-circle-right"></i></a>
    @endif
</div>
<!-- ./small box -->