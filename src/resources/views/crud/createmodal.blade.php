@extends('cesi::ajax')

<?php
$_listLink      = route($routerAlias.'.list');
$_storeLink     = route($routerAlias.'.store');
?>

@section('content')
    <form method="post" class="form-block" id="mainform" autocomplete="off"
        action="{{ $_storeLink }}"
        @if ($hasUploadFields))
            enctype="multipart/form-data"
        @endif
    >
        {!! csrf_field() !!}

        <input name="_ismodal" value="1" type="hidden">

        <div class="box box-default" id="wrap-edit-box">
            <div class="box-body">
                @include($resourceAlias.'.form')
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </form>
@endsection
