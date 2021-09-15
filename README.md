# PayPal - Upload Tracking

[![Latest Stable Version](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/v)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking) [![Total Downloads](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/downloads)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking) [![Latest Unstable Version](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/v/unstable)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking) [![License](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/license)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking) [![PHP Version Require](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/require/php)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking)

Thư viện được thiết kế hỗ trợ duy nhất 1 việc Upload Tracking lên PayPal

Thư viện được xây dựng dựa trên tài liệu chính thức của PayPal tại địa chỉ: https://developer.paypal.com/docs/api/tracking/v1/

## Các phương thức cung cấp

Thư viện hỗ trợ 2 Driver sau

- [x] Upload trực tiếp lên PayPal thông qua `clientId` và `secretId` tại Method `nguyenanhung\PayPal\UploadTracking\Services\PayPal\Tracking\Tracking::uploadTracking`
- [x] Upload thông qua hệ thống Payment Gateway riêng tại Method `nguyenanhung\PayPal\UploadTracking\Services\PaygateBride\BrideTracking::uploadTracking`

## Cài đặt phần mềm

Sử dụng composer để cài đặt thông qua lệnh sau:

```shell
composer require nguyenanhung/paypal-upload-tracking
```

### Samples Code

```php
<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/27/2021
 * Time: 04:40
 */
require_once __DIR__ . '/vendor/autoload.php';

use nguyenanhung\PayPal\UploadTracking\Services\PayPal\Tracking\Tracking;

$sdkConfig = [
    'partnerId'   => '',
    'prefix'      => '',
    'secretToken' => '',
];

$clientId                 = '';
$secretId                 = '';
$transactionId            = '';
$trackingNumber           = '';
$trackingCarrier          = '';
$trackingCarrierNameOther = '';
$fulfillmentStatus        = '';

$tracking = new Tracking();
$tracking->setSdkConfig($sdkConfig)
         ->setClientId($clientId)
         ->setSecretId($secretId)
         ->setTransactionId($transactionId)
         ->setTrackingNumber($trackingNumber)
         ->setTrackingCarrier($trackingCarrier)
         ->setTrackingCarrierNameOther($trackingCarrierNameOther)
         ->setFulfillmentStatus($fulfillmentStatus)
         ->requestAccessToken();

echo "<pre>";
print_r($tracking->uploadTracking());
echo "</pre>";
```

Tham khảo thêm về code mẫu tại `examples/`

## Bản quyền

Phân phối theo giấy phép: GNU GENERAL PUBLIC LICENSE

## Liên hệ

| Name        | Email                | Skype            | Facebook      |
| ----------- | -------------------- | ---------------- | ------------- |
| Hung Nguyen | dev@nguyenanhung.com | nguyenanhung5891 | @nguyenanhung |
