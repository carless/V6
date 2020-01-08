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
<!-- .info-box -->
<div class="info-box {{$item->classe}}">
    @if(isset($item->icono) && !empty($item->icono))
        <span class="info-box-icon"><i class="{{$item->icono}}"></i></span>
    @endif

    <div class="info-box-content">
        <span class="info-box-text">{{$item->titulo}}</span>
        <span class="info-box-number">{{$number}}</span>

        {{--
        <div class="progress">
            <div class="progress-bar" style="width: 70%"></div>
        </div>
        <span class="progress-description">
            70% Increase in 30 Days
        </span>
        --}}
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
