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

use Exception;
use nguyenanhung\PayPal\UploadTracking\Services\PayPal\PayPalREST;

/**
 * Class Tracking - Class cung cấp phương thức hỗ trợ đẩy tracking Paypal
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Services\PayPal\Tracking
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Tracking extends PayPalREST implements TrackingInterface
{
    /** @var array $multiTransactionData */
    protected $multiTransactionData;

    /** @var string $transactionId */
    protected $transactionId;

    /** @var string $trackingNumber */
    protected $trackingNumber;

    /** @var string $fulfillmentStatus */
    protected $fulfillmentStatus;

    /** @var string $trackingCarrier */
    protected $trackingCarrier;

    /** @var string|null $trackingCarrierNameOther */
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
        $url = $this->restEndpoint . '/v1/shipping/trackers-batch';
        if (isset($tracker['transaction_id'])) {
            $trackers = ['trackers' => [$tracker]];
        } else {
            $trackers = ['trackers' => $tracker];
        }


        return $this->sendRequest($url, $trackers);
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

    /**
     * Function updateOrCancelTracking - Hàm update, cancel thông tin tracking cho Paypal Transaction
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/27/2021 39:34
     *
     * @see      https://developer.paypal.com/docs/api/tracking/v1/#trackers
     */
    public function updateOrCancelTracking()
    {
        try {
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

            $updateTracking     = $this->trackers($this->transactionId, $this->trackingNumber, $dataTracking);
            $uploadTrackingJSON = $updateTracking['response'];
            $trackingReturn     = json_decode(trim($uploadTrackingJSON), true);

            // Prepare Raw Response of Request
            if (isset($updateTracking['rawResponse'])) {
                $uploadTrackingRawResponse = $updateTracking['rawResponse'];
                $trackingRawReturn         = json_decode(trim($uploadTrackingRawResponse), true);
            } else {
                $trackingRawReturn = $trackingReturn;
            }

            // Prepare tracking update
            if ($updateTracking['httpStatusCode'] > 204 || $updateTracking['httpStatusCode'] < 200) {
                $exitCode              = self::EXIT_ERROR;
                $exitMessage           = 'Error';
                $uploadTrackingMessage = "Data Tracking Status for TransactionID: " . $this->transactionId . " has Error - Error Information: " . trim($updateTracking['response']);
                $uploadTrackingStatus  = 'error';
            } else {
                $exitCode              = self::EXIT_SUCCESS;
                $exitMessage           = 'Successfully';
                $uploadTrackingMessage = "Data Tracking Status for TransactionID: " . $this->transactionId . " is Successfully - Information: " . trim($updateTracking['response']);
                $uploadTrackingStatus  = 'success';
            }

            // Response Data
            $response       = [
                'code'           => $exitCode,
                'name'           => $exitMessage,
                'status'         => $uploadTrackingStatus,
                'message'        => $uploadTrackingMessage,
                'method'         => __FUNCTION__,
                'httpStatusCode' => $updateTracking['httpStatusCode'],
                'data'           => $trackingRawReturn
            ];
            $this->response = $response;
        } catch (Exception $exception) {
            $this->setHasError();
            $response       = $this->exceptionResponseParse(__FUNCTION__, $exception);
            $this->response = $response;
        }

        return $this;
    }

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
    public function uploadTracking()
    {
        try {
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

            $uploadTracking     = $this->trackersBatch($dataTracking);
            $uploadTrackingJSON = $uploadTracking['response'];

            $trackingReturn = json_decode(trim($uploadTrackingJSON), true);

            // Prepare Raw Response of Request
            if (isset($uploadTracking['rawResponse'])) {
                $uploadTrackingRawResponse = $uploadTracking['rawResponse'];
                $trackingRawReturn         = json_decode(trim($uploadTrackingRawResponse), true);
            } else {
                $trackingRawReturn = $trackingReturn;
            }

            // Prepare tracking update
            if ($uploadTracking['httpStatusCode'] > 204 || $uploadTracking['httpStatusCode'] < 200) {
                $exitCode              = self::EXIT_ERROR;
                $exitName              = 'Error';
                $exitMessage           = 'Error';
                $uploadTrackingMessage = "Add Tracking for TransactionID: '.$this->transactionId.' has Error - Error Information: " . trim($uploadTracking['response']);
                $uploadTrackingStatus  = 'error';
            } else {
                if (isset($trackingReturn['errors']) && !empty($trackingReturn['errors'])) {
                    $exitCode              = self::EXIT_ERROR;
                    $exitName              = $trackingReturn['errors'][0]['name'] ?? 'Error';
                    $exitMessage           = $trackingReturn['errors'][0]['message'] ?? 'Error';
                    $uploadTrackingMessage = "Add Tracking for TransactionID: '.$this->transactionId.' has Error - Error Information: " . trim($uploadTracking['response']);
                    $uploadTrackingStatus  = 'error';
                } else {
                    $exitCode              = self::EXIT_SUCCESS;
                    $exitName              = 'Successfully';
                    $exitMessage           = 'Successfully';
                    $uploadTrackingMessage = "Add Tracking for TransactionID: '.$this->transactionId.' is Successfully - Information: " . trim($uploadTracking['response']);
                    $uploadTrackingStatus  = 'success';
                }
            }

            // Response Data
            $response       = [
                'code'           => $exitCode,
                'name'           => $exitName,
                'status'         => $uploadTrackingStatus,
                'message'        => $exitMessage,
                'errorMessage'   => $uploadTrackingMessage,
                'method'         => __FUNCTION__,
                'httpStatusCode' => $uploadTracking['httpStatusCode'],
                'data'           => $trackingRawReturn
            ];
            $this->response = $response;
        } catch (Exception $exception) {
            $this->setHasError();
            $response       = $this->exceptionResponseParse(__FUNCTION__, $exception);
            $this->response = $response;
        }

        return $this;
    }

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
    public function uploadMultiTracking()
    {
        try {
            // Tạo data để upload tracking lên hệ thống
            $countTrackingData = count($this->multiTransactionData);
            if ($countTrackingData < 1) {
                $this->setHasError();
                $response       = $this->errorResponseParse(self::EXIT_USER_INPUT, __FUNCTION__, 'Data Tracking Not Found or Empty');
                $this->response = $response;
            }

            $uploadTracking     = $this->trackersBatch($this->multiTransactionData);
            $uploadTrackingJSON = $uploadTracking['response'];

            $trackingReturn = json_decode(trim($uploadTrackingJSON), true);

            // Prepare Raw Response of Request
            if (isset($uploadTracking['rawResponse'])) {
                $uploadTrackingRawResponse = $uploadTracking['rawResponse'];
                $trackingRawReturn         = json_decode(trim($uploadTrackingRawResponse), true);
            } else {
                $trackingRawReturn = $trackingReturn;
            }

            // Prepare tracking update
            if ($uploadTracking['httpStatusCode'] > 204 || $uploadTracking['httpStatusCode'] < 200) {
                $exitCode              = self::EXIT_ERROR;
                $exitName              = 'Error';
                $exitMessage           = 'Error';
                $uploadTrackingMessage = "Upload Multi Tracking for has Error - Error Information: " . trim($uploadTracking['response']);
                $uploadTrackingStatus  = 'error';
            } else {
                if (isset($trackingReturn['errors']) && !empty($trackingReturn['errors'])) {
                    $exitCode              = self::EXIT_ERROR;
                    $exitName              = 'Found someone line error';
                    $exitMessage           = 'Defined error line in var data->errors right below';
                    $uploadTrackingMessage = "Upload Multi Tracking for has Someone Error - Error Information: " . trim($uploadTracking['response']);
                    $uploadTrackingStatus  = 'error';
                } else {
                    $exitCode              = self::EXIT_SUCCESS;
                    $exitName              = 'Successfully';
                    $exitMessage           = 'Successfully';
                    $uploadTrackingMessage = "Upload Multi Tracking for has Successfully - Error Information: " . trim($uploadTracking['response']);
                    $uploadTrackingStatus  = 'success';
                }
            }

            // Response Data
            $response       = [
                'code'           => $exitCode,
                'name'           => $exitName,
                'status'         => $uploadTrackingStatus,
                'message'        => $exitMessage,
                'errorMessage'   => $uploadTrackingMessage,
                'method'         => __FUNCTION__,
                'httpStatusCode' => $uploadTracking['httpStatusCode'],
                'data'           => $trackingRawReturn
            ];
            $this->response = $response;
        } catch (Exception $exception) {
            $this->setHasError();
            $response       = $this->exceptionResponseParse(__FUNCTION__, $exception);
            $this->response = $response;
        }

        return $this;
    }

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
    public function showTrackingInformation()
    {
        try {
            // Tạo data để upload tracking lên hệ thống
            $dataTracking                    = [];
            $dataTracking['transaction_id']  = $this->transactionId;
            $dataTracking['tracking_number'] = $this->trackingNumber;

            $updateTracking = $this->trackers($this->transactionId, $this->trackingNumber, $dataTracking, 'GET');

            $uploadTrackingJSON = $updateTracking['response'];
            $trackingReturn     = json_decode(trim($uploadTrackingJSON), true);

            // Prepare Raw Response of Request
            if (isset($updateTracking['rawResponse'])) {
                $uploadTrackingRawResponse = $updateTracking['rawResponse'];
                $trackingRawReturn         = json_decode(trim($uploadTrackingRawResponse), true);
            } else {
                $trackingRawReturn = $trackingReturn;
            }

            // Prepare tracking update
            if ($updateTracking['httpStatusCode'] > 204 || $updateTracking['httpStatusCode'] < 200) {
                $exitCode              = self::EXIT_ERROR;
                $exitMessage           = 'Error';
                $uploadTrackingMessage = "Get Information for TransactionID: " . $this->transactionId . " has Error - Error Information: " . trim($updateTracking['response']);
                $uploadTrackingStatus  = 'error';
            } else {
                $exitCode              = self::EXIT_SUCCESS;
                $exitMessage           = 'Successfully';
                $uploadTrackingMessage = "Get Information for TransactionID: " . $this->transactionId . " is Successfully - Information: " . trim($updateTracking['response']);
                $uploadTrackingStatus  = 'success';
            }

            // Response Data
            $response       = [
                'code'           => $exitCode,
                'name'           => $exitMessage,
                'status'         => $uploadTrackingStatus,
                'message'        => $uploadTrackingMessage,
                'method'         => __FUNCTION__,
                'httpStatusCode' => $updateTracking['httpStatusCode'],
                'data'           => $trackingRawReturn
            ];
            $this->response = $response;
        } catch (Exception $exception) {
            $this->setHasError();
            $response       = $this->exceptionResponseParse(__FUNCTION__, $exception);
            $this->response = $response;
        }

        return $this;
    }
}
