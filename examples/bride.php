<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/27/2021
 * Time: 04:40
 */
require_once __DIR__ . '/../vendor/autoload.php';

use nguyenanhung\PayPal\UploadTracking\Services\PaygateBride\BrideTracking;

$sdkConfig = [
    'partnerId'   => '',
    'prefix'      => '',
    'secretToken' => '',
    'hostname'    => ''
];

$clientId                 = '';
$secretId                 = '';
$transactionId            = '';
$trackingNumber           = '';
$trackingCarrier          = '';
$trackingCarrierNameOther = '';
$fulfillmentStatus        = '';

$tracking = new BrideTracking();
$tracking->setSdkConfig($sdkConfig)
         ->setRequestId(uniqid())
         ->setTransactionId($transactionId)
         ->setTrackingNumber($trackingNumber)
         ->setTrackingCarrier($trackingCarrier)
         ->setTrackingCarrierNameOther($trackingCarrierNameOther)
         ->setFulfillmentStatus($fulfillmentStatus);

echo "<pre>";
print_r($tracking->uploadTracking());
echo "</pre>";