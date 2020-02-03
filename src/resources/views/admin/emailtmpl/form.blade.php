<?php
$lstThemes = \Cesi\Core\app\App\Helpers\CesiCoreHelper::getEmailTmplTheme();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="card card-primary">
                <div class="card-body form-horizontal">
                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                        {{ Form::label('name' , trans('cesi::core.emailtmpl.fields.name'). '* :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('name', old('name', $entry->name), ['class' => 'form-control', 'autofocus', 'placeholder' => '', 'required' => 'required',]) }}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('slug') ? ' has-error' : '' }}">
                        {{ Form::label('slug' , trans('cesi::core.emailtmpl.fields.slug'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('slug', old('slug', $entry->slug), ['class' => 'form-control', 'placeholder' => '', ]) }}
                            @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('theme') ? ' has-error' : '' }}">
                        {{ Form::label('theme' , trans('cesi::core.emailtmpl.fields.theme'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                            {{ Form::select('theme', $lstThemes, old('theme', $entry->theme), ['class' => 'form-control select2bs4', 'data-minimum-results-for-search' => 'Infinity']) }}

                            @if ($errors->has('theme'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('theme') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('cc_email') ? ' has-error' : '' }}">
                        {{ Form::label('cc_email' , trans('cesi::core.emailtmpl.fields.cc_email'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('cc_email', old('cc_email', $entry->cc_email), ['class' => 'form-control', 'placeholder' => '', ]) }}
                            @if ($errors->has('cc_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cc_email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('subject') ? ' has-error' : '' }}">
                        {{ Form::label('subject' , trans('cesi::core.emailtmpl.fields.subject'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            {{ Form::text('subject', old('subject', $entry->subject), ['class' => 'form-control', 'placeholder' => '', ]) }}
                            @if ($errors->has('subject'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('content') ? ' has-error' : '' }}">
                        {{ Form::label('content' , trans('cesi::core.emailtmpl.fields.content'). ' :', ['class' => 'col-lg-2 col-md-2 col-sm-2 col-xs-12 col-form-label']) }}

                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            @include('cesi::core.crud.fields.editorhtml', [ 'field' => ['name' => 'content', 'value' => $entry->content]])

                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="card card-primary">
                <div class="card-body">
                    @include('cesi::core.admin.info_horizontal')
                </div>
            </div>
        </div>
    </div>
</div>


@push('after_scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endpush
