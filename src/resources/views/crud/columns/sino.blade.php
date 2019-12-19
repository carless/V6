<?php
$value = (Boolean)$entry->{$column['name']};
if ($value) {
    print '<i class="far fa-check-square"></i>';
} else {
    print '<i class="far fa-square"></i>';
}