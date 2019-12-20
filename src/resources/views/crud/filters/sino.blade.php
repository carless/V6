<div class="filtro filtro_slc_sino">
    <?php // \Cesi\Core\Helpers\CesiHelper::wdd($filtro); ?>
    <label for="filter_{{$filtro->name}}" class="label_filter">{{$filtro->label}}</label>
    <div class="clearfix"></div>
    <select id="filter_{{$filtro->name}}" name="filter[{{$filtro->name}}]" onchange="this.form.submit();" class="form-control">
        <?php
        print "<option value='' ";
        if (is_null($filtro->currentValue) || empty($filtro->currentValue)) {
            print "selected='selected'";
        }
        print ">- Todos -</option>";

        print "<option value='1' ";
        if ($filtro->currentValue=="1") {
            print "selected='selected'";
        }
        print ">SI</option>";

        print "<option value='0' ";
        if ($filtro->currentValue=="0") {
            print "selected='selected'";
        }
        print ">NO</option>";
        ?>
    </select>
</div>