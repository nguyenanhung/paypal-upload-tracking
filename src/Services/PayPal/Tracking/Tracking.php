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

use nguyenanhung\PayPal\UploadTracking\Services\PayPal\PaypalREST;

/**
 * Class Tracking - Class cung cấp phương thức hỗ trợ đẩy tracking Paypal
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Services\PayPal\Tracking
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Tracking extends PaypalREST implements TrackingInterface
{
    protected $multiTransactionData;
    protected $transactionId;
    protected $trackingNumber;
    protected $fulfillmentStatus;
    protected $trackingCarrier;
    protected $trackingCarrierNameOther;

    /**
     * Tracking constructor.
     *
     * @param array $options
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct(array $options = array())
    {
        parent::__construct($options);
    }

    /**
     * Function trackers - Update or cancel tracking information for PayPal transaction
     *
     * @param string $transaction_id
     * @param string $tracking_number
     * @param array  $data
     * @param string $method
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 14:40
     *
     * @see      https://developer.paypal.com/docs/api/tracking/v1/#trackers
     */
    protected function trackers(string $transaction_id, string $tracking_number, array $data, $method = 'PUT')
    {
        $url = $this->restEndpoint . '/v1/shipping/trackers/' . trim($transaction_id) . '-' . trim($tracking_number);

        return $this->sendRequest($url, $data, $method);
    }

    /**
     * Function trackersBatch - Add tracking information for multiple PayPal transactions
     *
     * @param array $tracker
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/26/2021 43:07
     *
     * @see      https://developer.paypal.com/docs/api/tracking/v1/#trackers-batch
     */
    protected function trackersBatch(array $tracker)
    {
        $url      = $this->restEndpoint . '/v1/shipping/trackers-batch';
        $trackers = ['trackers' => [$tracker]];

        return $this->sendRequest($url, $trackers);
    }

    /**
     * Function uploadTracking - Hàm update, cancel thông tin tracking cho Paypal Transaction
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 39:34
     */
    public function uploadTracking()
    {
        // Tạo data để upload tracking lên hệ thống
        $dataTracking                    = [];
        $dataTracking['transaction_id']  = $this->transactionId;
        $dataTracking['tracking_number'] = $this->trackingNumber;
        $dataTracking['status']          = $this->fulfillmentStatus;
        if (!empty($this->trackingCarrier)) {
            $dataTracking['carrier'] = $this->trackingCarrier;
        }
        if (!empty($this->trackingCarrierNameOther)) {
            $dataTracking['carrier_name_other'] = $this->trackingCarrierNameOther;
        }

        $uploadTracking = $this->trackers($this->transactionId, $this->trackingNumber, $dataTracking);

        // Prepare tracking update
        if ($uploadTracking['httpStatusCode'] != 204) {
            $exitCode              = self::EXIT_ERROR;
            $uploadTrackingMessage = "Upload Tracking for TransactionID: " . $this->transactionId . " has Error";
            $uploadTrackingStatus  = 'error';
        } else {
            $exitCode              = self::EXIT_SUCCESS;
            $uploadTrackingMessage = "Upload Tracking for TransactionID: " . $this->transactionId . " has Successfully";
            $uploadTrackingStatus  = 'success';
        }

        // Response Data
        $response       = [
            'code'           => $exitCode,
            'status'         => $uploadTrackingStatus,
            'message'        => $uploadTrackingMessage,
            'method'         => __FUNCTION__,
            'httpStatusCode' => $uploadTracking['httpStatusCode'],
            'data'           => $uploadTracking['response']
        ];
        $this->response = $response;

        return $this;
    }

    /**
     * Function uploadMultiTracking - Hàm add Tracking information cho nhiều Paypal Transaction
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 08:17
     */
    public function uploadMultiTracking()
    {
        // Tạo data để upload tracking lên hệ thống
        $countTrackingData = count($this->multiTransactionData);
        if ($countTrackingData < 1) {
            $this->setHasError();
            $response       = $this->errorResponseParse(self::EXIT_USER_INPUT, __FUNCTION__, 'Data Tracking Not Found or Empty');
            $this->response = $response;
        }

        $uploadTracking = $this->trackersBatch($this->multiTransactionData);

        // Prepare tracking update
        if ($uploadTracking['httpStatusCode'] != 204) {
            $exitCode              = self::EXIT_ERROR;
            $uploadTrackingMessage = "Upload Multi Tracking for has Error";
            $uploadTrackingStatus  = 'error';
        } else {
            $exitCode              = self::EXIT_SUCCESS;
            $uploadTrackingMessage = "Upload Multi Tracking for has Successfully";
            $uploadTrackingStatus  = 'success';
        }
        // Response Data
        $response       = [
            'code'           => $exitCode,
            'status'         => $uploadTrackingStatus,
            'message'        => $uploadTrackingMessage,
            'method'         => __FUNCTION__,
            'httpStatusCode' => $uploadTracking['httpStatusCode'],
            'data'           => $uploadTracking['response']
        ];
        $this->response = $response;

        return $this;
    }

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
    public function setMultiTransactionData($multiTransactionData)
    {
        $this->multiTransactionData = $multiTransactionData;

        return $this;
    }

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
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

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
    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;

        return $this;
    }

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
    public function setFulfillmentStatus($fulfillmentStatus)
    {
        $this->fulfillmentStatus = $fulfillmentStatus;

        return $this;
    }

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
    public function setTrackingCarrier($trackingCarrier)
    {
        $this->trackingCarrier = $trackingCarrier;

        return $this;
    }

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
    public function setTrackingCarrierNameOther($trackingCarrierNameOther)
    {
        $this->trackingCarrierNameOther = $trackingCarrierNameOther;

        return $this;
    }
}
