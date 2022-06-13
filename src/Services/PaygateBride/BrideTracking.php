<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/27/2021
 * Time: 04:49
 */

namespace nguyenanhung\PayPal\UploadTracking\Services\PaygateBride;

use Exception;
use nguyenanhung\PayPal\UploadTracking\Base\BaseCore;
use nguyenanhung\PayPal\UploadTracking\Curl\Curl;

/**
 * Class BrideTracking
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Services\PaygateBride
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class BrideTracking extends BaseCore
{
    protected $requestId;
    protected $sandbox;
    protected $multiTransactionData;
    protected $transactionId;
    protected $trackingNumber;
    protected $fulfillmentStatus;
    protected $trackingCarrier;
    protected $trackingCarrierNameOther;

    /**
     * BrideTracking constructor.
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
     * Function sendRequest
     *
     * @param string       $url
     * @param array|string $data
     * @param string       $method
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 03:22
     */
    protected function sendRequest(string $url = '', $data = array(), string $method = 'GET')
    {
        try {
            $curl = new Curl();

            $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
            $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
            $curl->setOpt(CURLOPT_ENCODING, "utf-8");
            $curl->setOpt(CURLOPT_MAXREDIRS, 10);
            $curl->setOpt(CURLOPT_TIMEOUT, 300);
            $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);

            if ('POST' == $method) {
                $curl->post($url, $data);
            } else {
                $curl->get($url, $data);
            }
            if ($curl->error) {
                if (isset($curl->errorMessage)) {
                    $response = "cURL Error: " . $curl->errorMessage;
                } else {
                    $response = "cURL Error: " . $curl->error_message;
                }
            } else {
                $response = $curl->response;
            }
            $curl->close();

            return $response;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Function setSandbox
     *
     * @param $sandbox
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 00:46
     */
    public function setSandbox($sandbox): BrideTracking
    {
        $this->sandbox = $sandbox;

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
    public function setMultiTransactionData($multiTransactionData): BrideTracking
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
    public function setTransactionId($transactionId): BrideTracking
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
    public function setTrackingNumber($trackingNumber): BrideTracking
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
    public function setFulfillmentStatus($fulfillmentStatus): BrideTracking
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
    public function setTrackingCarrier($trackingCarrier): BrideTracking
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
    public function setTrackingCarrierNameOther($trackingCarrierNameOther): BrideTracking
    {
        $this->trackingCarrierNameOther = $trackingCarrierNameOther;

        return $this;
    }

    /**
     * Function setRequestId
     *
     * @param $requestId
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 53:47
     */
    public function setRequestId($requestId): BrideTracking
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Function uploadTracking
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 06:39
     */
    public function uploadTracking(): BrideTracking
    {
        $path        = '/api/v1/uploadTracking';
        $hostname    = $this->sdkConfig['hostname'];
        $prefix      = $this->sdkConfig['prefix'];
        $secretToken = $this->sdkConfig['secretToken'];
        $partnerId   = $this->sdkConfig['partnerId'];
        if ($this->sandbox === true || $this->sandbox === 'YES') {
            $sandbox = 'YES';
        } else {
            $sandbox = 'NO';
        }
        $signature = hash('sha1', $this->requestId . $prefix . $partnerId . $prefix . $secretToken);
        $url       = $hostname . $path;
        $params    = [
            'requestId'        => $this->requestId,
            'partnerId'        => $partnerId,
            'signature'        => $signature,
            'transactionId'    => $this->transactionId,
            'trackingNumber'   => $this->trackingNumber,
            'status'           => $this->fulfillmentStatus,
            'carrier'          => $this->trackingCarrier,
            'carrierNameOther' => $this->trackingCarrierNameOther,
            'sandbox'          => $sandbox
        ];
        $request   = $this->sendRequest($url, $params);
        if (is_array($request) || is_object($request)) {
            $request = json_encode($request);
        }
        $res = json_decode(trim($request));
        if (isset($res->code) && $res->code === self::EXIT_SUCCESS) {
            $response = [
                'code'    => self::EXIT_SUCCESS,
                'message' => 'Success'
            ];
        } else {
            $response = [
                'code'    => self::EXIT_SUCCESS,
                'message' => 'Failed'
            ];
        }
        $this->response = $response;

        return $this;
    }
}
