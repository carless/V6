<div class="filtro filtro_select filtro_{{$filtro->name}}" style="float:left;">
    <label for="filter_{{$filtro->name}}" class="label_filter">{{$filtro->label}}</label>
    <div class="clearfix"></div>
    <select id="filter_{{$filtro->name}}" name="filter[{{$filtro->name}}]" onchange="this.form.submit();" class="form-control">';
    <?php
    // \Cesi\Core\Helpers\CesiHelper::wdd($filtro);

    // $dflt_value = '-1';
    // if (isset($filtro->values) && $filtro->values) {
    //    $dflt_value = $filtro->values;
    // }

    // print '<select id="filter_' . $filtro->name .'" name="filter['.$filtro->name .']" onchange="this.form.submit();" class="form-control select2">';
    print "<option value='' ";
    if (is_null($filtro->currentValue) || empty($filtro->currentValue)) {
        print "selected='selected'";
    }
    print ">- Todos -</option>";

    if (isset($filtro->options['datos'])) {
       foreach ($filtro->options['datos'] as $key => $value) {
            print '<option value="' . $key . '"';
            if ($key == $filtro->currentValue) {
                print ' selected';
            }
            print '>' . $value ."</option>";
       }
    }
    // echo '</select>';
    // $list_values = $filtro['datos'];
    ?>
    </select>
</div>
