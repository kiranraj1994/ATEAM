<?php
function dateFormat($date){
    return date('Y-m-d',strtotime($date));
}
function dateFormatDMY($date){
    return date('d-m-Y',strtotime($date));
}