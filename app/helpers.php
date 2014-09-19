<?php

/*
 * Format an UTF dateTime string into current +08:00 timezone date time
 */
function formatDateTime($dateTimeString) {
    return (new DateTime($dateTimeString))->setTimezone(new DateTimeZone('Asia/Shanghai'))->format('Y-m-d H:i:s');
}


/*
 * Format an UTF dateTime string into current +08:00 timezone date
 */
function formatDate($dateTimeString) {
    return (new DateTime($dateTimeString))->setTimezone(new DateTimeZone('Asia/Shanghai'))->format('Y-m-d');
}


