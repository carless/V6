<?php
$percent = $entry->{$column['name']};
if ($percent<=0) {
    $percent = 0;
}
if ($percent>=100) {
    $percent = 100;
}
?>
<div style="width:100%;text-align:center;">{{ number_format($percent, 2, '.', '') }} %</div>
<div class="progress progress-xs" style="margin-top:0px;">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$percent}}%">
    </div>
</div>
