<?php

/*
 * Format an UTF dateTime string into current +08:00 timezone date time
 */
function formateDateTime($dateTimeString) {
    return (new DateTime($dateTimeString))->setTimezone(new DateTimeZone('Asia/Shanghai'))->format('Y-m-d H:i:s') . "\n";
}


/*
 * Format an UTF dateTime string into current +08:00 timezone date
 */
function formateDate($dateTimeString) {
    return (new DateTime($dateTimeString))->setTimezone(new DateTimeZone('Asia/Shanghai'))->format('Y-m-d') . "\n";
}


