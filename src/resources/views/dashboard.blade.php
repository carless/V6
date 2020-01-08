@extends('cesi::layout')

@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-6">
                    <h1 class="m-0 text-dark">
                        {{ trans('cesi::core.dashboard.title') }}
                    </h1>
                </div><!-- /.col -->
                <div class="col-6">
                </div><!-- /.col -->
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <?php
        $mod_left  = 0;
        $mod_right = 0;
        $width_left  = 3;
        $width_right = 3;
        $width_center= 6;

        if (isset($positions['left']) && count($positions['left'])>=1) {
            $mod_left = count($positions['left']);
        }
        if (isset($positions['right']) && count($positions['right'])>=1) {
            $mod_right = count($positions['right']);
        }

        $width_center = 12 - ($mod_left ? $width_left : 0) - ($mod_right ? $width_right : 0);
        ?>
        <!-- Small boxes (Stat box) -->
        @if (isset($positions['top']) && count($positions['top'])>=1)
            <div class="row">
                @foreach ($positions['top'] as $item)
                    <!-- col -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <?php
                        $cfg = $item->config;
                        $type = $item->tipo;
                        ?>
                        @include('cesi::core.dashboarditems.' . $type, ['item' => $cfg])
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="row">
            @if ($mod_left)
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    @foreach ($positions['left'] as $item)
                        <?php
                        $cfg = $item->config;
                        $type = $item->tipo;
                        ?>
                        @include('cesi::core.dashboarditems.' . $type, ['item' => $cfg])
                    @endforeach
                </div>
            @endif

            <div class="col-lg-{{$width_center}} col-md-{{$width_center}} col-sm-6 col-12">
                @foreach ($positions['center'] as $item)
                    <?php
                    $cfg = $item->config;
                    $type = $cfg->tipo;
                    ?>
                    @include('cesicore::dashboarditems.'. $type, ['item' => $cfg])
                @endforeach
            </div>

            @if ($mod_right)
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    @foreach ($positions['right'] as $item)
                        <?php
                        $cfg = $item->config;
                        $type = $item->tipo;
                        ?>
                        @include('cesi::core.dashboarditems.' . $type, ['item' => $cfg])
                    @endforeach
                </div>
            @endif
        </div>

        @if (isset($positions['bottom']) && count($positions['bottom'])>=1)
            <div class="row">
                @foreach ($positions['bottom'] as $item)
                    <!-- col -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                        <?php
                        $cfg = $item->config;
                        $type = $item->tipo;
                        ?>
                        @include('cesi::core.dashboarditems.' . $type, ['item' => $cfg])
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection