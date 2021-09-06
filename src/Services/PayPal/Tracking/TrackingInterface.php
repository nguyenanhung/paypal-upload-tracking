<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/11/2021
 * Time: 04:12
 */

namespace nguyenanhung\PayPal\UploadTracking\Services\PayPal\Tracking;

/**
 * Interface TrackingInterface
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Services\PayPal\Tracking
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface TrackingInterface
{
    /**
     * Function setMultiTransactionData
     *
     * @param $multiTransactionData
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 46:39
     */
    public function setMultiTransactionData($multiTransactionData);

    /**
     * Function setTransactionId
     *
     * @param $transactionId
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 46:36
     */
    public function setTransactionId($transactionId);

    /**
     * Function setTrackingNumber
     *
     * @param $trackingNumber
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 46:32
     */
    public function setTrackingNumber($trackingNumber);

    /**
     * Function setFulfillmentStatus
     *
     * @param $fulfillmentStatus
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 46:30
     */
    public function setFulfillmentStatus($fulfillmentStatus);

    /**
     * Function setTrackingCarrier
     *
     * @param $trackingCarrier
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 46:27
     */
    public function setTrackingCarrier($trackingCarrier);

    /**
     * Function setTrackingCarrierNameOther
     *
     * @param $trackingCarrierNameOther
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 46:23
     */
    public function setTrackingCarrierNameOther($trackingCarrierNameOther);

    /**
     * Function updateOrCancelTracking - Hàm update, cancel thông tin tracking cho Paypal Transaction
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 39:34
     *
     * @see      https://developer.paypal.com/docs/api/tracking/v1/#trackers
     */
    public function updateOrCancelTracking();

    /**
     * Function uploadTracking - Hàm add Tracking information cho 1 line Paypal Transaction
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 29:46
     *
     * @see      https://developer.paypal.com/docs/api/tracking/v1/#trackers-batch
     */
    public function uploadTracking();

    /**
     * Function uploadMultiTracking - Hàm add Tracking information cho nhiều Paypal Transaction
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 08:17
     *
     * @see      https://developer.paypal.com/docs/api/tracking/v1/#trackers-batch
     */
    public function uploadMultiTracking();

    /**
     * Function showTrackingInformation - Show tracking information
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 42:05
     *
     * @see      https://developer.paypal.com/docs/api/tracking/v1/#trackers_get
     */
    public function showTrackingInformation();
}
