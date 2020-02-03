<?php
?>

<textarea class="form-control" id="{{$field['name']}}" name="{{$field['name']}}" cols="50" rows="10"><?php print $field['value'];?></textarea>

@push('after_scripts')
    <script type="text/javascript">
        jQuery(document).ready(function($) {

        });
    </script>
@endpush
