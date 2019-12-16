<div class="form-horizontal">
    <div class="form-group row margin-b-5 margin-t-5">
        <label for="id" class="col-md-5 col-sm-5 col-xs-12 col-form-label text-right">{{ trans('cesi::core.crud.fields.ID') }} :</label>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <input type="text" class="form-control" name="id" value="{{ old('id', $entry->id) }}" placeholder="ID" readonly="readonly">
        </div>
    </div>

    <div class="form-group row margin-b-5 margin-t-5">
        <label for="created_at" class="col-md-5 col-sm-5 col-xs-12 col-form-label text-right">{{ trans('cesi::core.crud.fields.created_at') }} :</label>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <?php
            if (isset($entry->created_at) && ( $entry->created_at instanceof \Carbon\Carbon )) {
                $entry->created_at = $entry->created_at->toDateTimeString();
            }
            ?>
            <input type="text" class="form-control" name="created_at" value="{{ old('created_at', $entry->created_at) }}" placeholder="created_at" readonly="readonly">
        </div>
    </div>

    <div class="form-group row margin-b-5 margin-t-5">
        <label for="created_by" class="col-md-5 col-sm-5 col-xs-12 col-form-label text-right">{{ trans('cesi::core.crud.fields.created_by') }} :</label>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <?php
            $dspName = '';
            if (isset($entry->created_by) && ($entry->created_by>=1)) {
                $dspName = App\User::find($entry->created_by)->name;
            }
            ?>
            <input type="hidden" class="form-control" name="created_by" value="{{ old('created_by', $entry->created_by) }}" placeholder="created_by" readonly="readonly">
            <input type="text" class="form-control" name="dsp_created_by" value="{{ $dspName }}" placeholder="dsp_created_by" readonly="readonly">
        </div>
    </div>

    <div class="form-group row margin-b-5 margin-t-5">
        <label for="updated_at" class="col-md-5 col-sm-5 col-xs-12 col-form-label text-right">{{ trans('cesi::core.crud.fields.updated_at') }} :</label>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <?php
            if (isset($entry->updated_at) && ( $entry->updated_at instanceof \Carbon\Carbon )) {
                $entry->updated_at = $entry->updated_at->toDateTimeString();
            }
            ?>
            <input type="text" class="form-control" name="updated_at" value="{{ old('updated_at', $entry->updated_at) }}" placeholder="updated_at" readonly="readonly">
        </div>
    </div>

    <div class="form-group row margin-b-5 margin-t-5">
        <label for="updated_by" class="col-md-5 col-sm-5 col-xs-12 col-form-label text-right">{{ trans('cesi::core.crud.fields.updated_by') }} :</label>
        <div class="col-md-7 col-sm-7 col-xs-12">
            <?php
            $dspName = '';
            if (isset($entry->updated_by) && ($entry->updated_by>=1)) {
                $dspName = App\User::find($entry->updated_by)->name;
            }
            ?>
            <input type="hidden" class="form-control" name="updated_by" value="{{ old('updated_by', $entry->updated_by) }}" placeholder="updated_by" readonly="readonly">
            <input type="text" class="form-control" name="dsp_updated_by" value="{{ $dspName }}" placeholder="dsp_updated_by" readonly="readonly">
        </div>
    </div>
</div>