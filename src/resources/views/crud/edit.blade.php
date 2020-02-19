@extends('cesi::layout')

<?php
$_listLink      = route($routerAlias.'.list');
$_updateLink    = route($routerAlias.'.update', $entry->getKey());
?>
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <span class="text-capitalize">{!! $heading !!}</span>
                        <small>{!! $subheading !!}.</small>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="box-actions float-right">
                        <a href="{{ $_listLink }}" class="btn btn-sm btn-danger margin-r-5 margin-l-5">
                            <i class="fa fa-ban"></i> <span>{{ trans('cesi::core.crud.cancel') }}</span>
                        </a>

                        <button id="toolbar-save" class="btn btn-sm btn-success" onclick="jQuery('#mainform').submit();">
                            <i class="fa fa-save"></i> <span>{{ trans('cesi::core.crud.save') }}</span>
                        </button>
                    </div>
                </div><!-- /.col -->
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="{{ $contentClass }}">
            <form method="post" class="form-block" id="mainform" autocomplete="off"
                  action="{{ $_updateLink }}"
                  @if ($hasUploadFields)
                        enctype="multipart/form-data"
                  @endif
                >
                {!! csrf_field() !!}
                {!! method_field('PUT') !!}

                <div class="box box-default" id="wrap-edit-box">
                    <div class="box-body">
                        @include($resourceAlias.'.form')
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </form>
        </div>
    </div> <!-- /.row -->
@endsection
