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

/*
 * get the difference in days
 */

function getDateDiffToNow($date) {
    $dateNow = new DateTime();
    return abs($dateNow->diff(new DateTime($date))->days);
}

/*
 * transform an order ID into trade number accepted by payment vendor
 */

function generateTradeNumber($orderId) {
    $date = new DateTime();
    $prefix = 'CN' . $date->setTimezone(new DateTimeZone('Asia/Shanghai'))->format('ymd');
    return $prefix . str_pad($orderId, Config::get('optimall.orderCodeLength'), "0", STR_PAD_LEFT);
}
