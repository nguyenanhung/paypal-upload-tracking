# Change Log

[![Latest Stable Version](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/v)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking) [![Total Downloads](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/downloads)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking) [![Latest Unstable Version](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/v/unstable)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking) [![License](http://poser.pugx.org/nguyenanhung/paypal-upload-tracking/license)](https://packagist.org/packages/nguyenanhung/paypal-upload-tracking)

Change Log được viết theo biểu mẫu tại đây: https://keepachangelog.com/en/1.0.0/

## [1.0.3] - 2022/06/13

## Update

- [x] Refactoring phần request tới API của PayPal

## [1.0.2] - 2021/09/06

## Update

- [x] Cung cấp thư viện với đầy đủ các hàm liên kết tới API Tracking của PayPal

## [1.0.1] - 2021/09/04

## Fixed

- [x] Fix lỗi upload tracking lên PayPal không detect được response

## [1.0.0] - 2021/08/27

## Add

Thư viện được thiết kế hỗ trợ duy nhất 1 việc Upload Tracking lên PayPal

Thư viện hỗ trợ 2 Driver sau

- [x] Upload trực tiếp lên PayPal thông qua `clientId` và `secretId` tại Method `nguyenanhung\PayPal\UploadTracking\Services\PayPal\Tracking\Tracking::uploadTracking`
- [x] Upload thông qua hệ thống Payment Gateway riêng tại Method `nguyenanhung\PayPal\UploadTracking\Services\PaygateBride\BrideTracking::uploadTracking`

Hướng dẫn sử dụng: Tham khảo thư mục `examples/`

## Liên hệ

| Name        | Email                | Skype            | Facebook      |
|-------------|----------------------|------------------|---------------|
| Hung Nguyen | dev@nguyenanhung.com | nguyenanhung5891 | @nguyenanhung |
