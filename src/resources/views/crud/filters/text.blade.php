<div class="filtro filtro_select filtro_{{$filtro->name}}" style="float:left;">
    <label for="filter_{{$filtro->name}}" class="label_filter">{{$filtro->label}}</label>
    <div class="clearfix"></div>
    <input  class="form-control" type="text" name="filter[{{$filtro->name}}]" id="filter_{{$filtro->name}}" value="{{ $filtro->currentValue }}" />
</div>
