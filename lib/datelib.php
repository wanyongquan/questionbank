<?php
function getCurrentDatetime(){
    $timezone = ini_get('date.timezone');
    $datetimezone = new DateTimeZone($timezone);
    $datetime = new DateTime("now", $datetimezone);
    return $datetime->format("Y-m-d H:i:s");
}
