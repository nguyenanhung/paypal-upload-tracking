<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/11/2021
 * Time: 04:12
 */

namespace nguyenanhung\PayPal\UploadTracking\Services\PayPal;

use Curl\Curl;
use nguyenanhung\PayPal\UploadTracking\Base\BaseCore;

/**
 * Class PayPalREST
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Services\PayPal
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class PayPalREST extends BaseCore
{
    const PARTNER_IS_ON = 'on';
    const USE_IS_YES    = 'yes';

    use PayPalServicesTrait;

    /** @var bool $sandbox */
    protected $sandbox;
    /** @var string $restEndpoint */
    protected $restEndpoint;
    /** @var string $clientId */
    protected $clientId;
    /** @var string $secretId */
    protected $secretId;
    /** @var string $accessToken */
    protected $accessToken;
    /** @var bool $hasError */
    protected $hasError = false;

    /**
     * PaypalREST constructor.
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
     * Function setSandbox
     *
     * @param false $sandbox
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 41:41
     */
    public function setSandbox($sandbox = false)
    {
        $this->sandbox = $sandbox;
        if ($this->sandbox === true) {
            $this->restEndpoint = PaypalConstants::PAYPAL_REST_SANDBOX_HOSTNAME;
        } else {
            $this->restEndpoint = PaypalConstants::PAYPAL_REST_HOSTNAME;
        }

        return $this;
    }

    /**
     * Function getSandbox
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 18:27
     */
    public function getSandbox()
    {
        return $this->sandbox;
    }

    /**
     * Function setRestEndpoint
     *
     * @param $restEndpoint
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 15:44
     */
    public function setRestEndpoint($restEndpoint)
    {
        $this->restEndpoint = $restEndpoint;

        return $this;
    }

    /**
     * Function getRestEndpoint
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 18:23
     */
    public function getRestEndpoint()
    {
        return $this->restEndpoint;
    }

    /**
     * Function setClientId
     *
     * @param $clientId
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 41:49
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Function getClientId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 18:19
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Function setSecretId
     *
     * @param $secretId
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 41:58
     */
    public function setSecretId($secretId)
    {
        $this->secretId = $secretId;

        return $this;
    }

    /**
     * Function getSecretId
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 18:10
     */
    public function getSecretId()
    {
        return $this->secretId;
    }

    /**
     * Function getAccessToken
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/06/2021 18:15
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Function setAccessToken
     *
     * @param $accessToken
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 49:15
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Function requestAccessToken
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 01:43
     */
    public function requestAccessToken()
    {
        if ($this->sandbox === true) {
            $url = PaypalConstants::PAYPAL_REST_SANDBOX_HOSTNAME . '/v1/oauth2/token';
        } else {
            $url = PaypalConstants::PAYPAL_REST_HOSTNAME . '/v1/oauth2/token';
        }
        $params = ['grant_type' => 'client_credentials'];
        $curl   = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt(CURLOPT_ENCODING, "utf-8");
        $curl->setOpt(CURLOPT_MAXREDIRS, 10);
        $curl->setOpt(CURLOPT_TIMEOUT, 60);
        $curl->setBasicAuthentication($this->clientId, $this->secretId);
        $curl->post($url, $params);
        // Response
        $rawResponse = $curl->rawResponse ?? $curl->response;
        $result      = $curl->error ? "cURL Error: " . $curl->errorMessage : $rawResponse;
        // Close Request
        $curl->close();
        $res               = json_decode(trim($result));
        $this->accessToken = $res->access_token ?? null;

        return $this;
    }

    /**
     * Function sendRequest
     *
     * @param string $url
     * @param array  $data
     * @param string $method
     * @param int    $timeout
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/05/2021 24:37
     */
    public function sendRequest($url = '', $data = array(), $method = 'JSON', $timeout = 60)
    {
        $getMethod = strtoupper($method);
        $curl      = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        $curl->setOpt(CURLOPT_ENCODING, "utf-8");
        $curl->setOpt(CURLOPT_MAXREDIRS, 10);
        $curl->setOpt(CURLOPT_TIMEOUT, $timeout);
        if ('POST' == $getMethod) {
            $curl->post($url, $data);
        } elseif ('JSON' == $getMethod) {
            $curl->setHeader("Authorization", 'Bearer ' . $this->accessToken);
            $curl->setHeader("Content-Type", "application/json");
            $curl->post($url, json_encode($data));
        } elseif ('PUT' == $getMethod) {
            $curl->setHeader("Authorization", 'Bearer ' . $this->accessToken);
            $curl->setHeader("Content-Type", "application/json");
            $curl->put($url, json_encode($data));
        } else {
            $curl->get($url, $data);
        }

        // Đoạn xử lý này nhằm polyfill namespace Curl\Curl

        $rawResponse = $curl->rawResponse ?? $curl->response;
        $response    = $curl->error ? "cURL Error: " . $curl->errorMessage : $rawResponse;
        if (isset($curl->httpStatusCode)) {
            $httpStatusCode = $curl->httpStatusCode;
        } elseif (isset($curl->http_status_code)) {
            $httpStatusCode = $curl->http_status_code;
        } else {
            $httpStatusCode = 0;
        }

        // Close Request
        $curl->close();

        // Return Response
        return [
            "response"       => $response,
            "rawResponse"    => $rawResponse,
            "httpStatusCode" => $httpStatusCode
        ];
    }

    /**
     * Function exceptionResponseParse - Tạo mã phản hồi trong trường hợp có lỗi Exception xảy ra
     *
     * @param $method
     * @param $exception
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/26/2021 36:26
     */
    protected function exceptionResponseParse($method, $exception)
    {
        return [
            'code'    => self::EXIT_ERROR,
            'message' => 'Error',
            'step'    => $method,
            'error'   => [
                'message'    => 'ErrorException',
                'getMessage' => $exception->getMessage()
            ]
        ];
    }

    /**
     * Function errorResponseParse - Tạo mã phản hồi trong trường hợp có lỗi xảy ra
     *
     * @param $code
     * @param $step
     * @param $message
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/26/2021 45:03
     */
    protected function errorResponseParse($code, $step, $message)
    {
        return [
            'code'    => $code,
            'message' => 'Error',
            'step'    => $step,
            'error'   => [
                'message' => $message
            ]
        ];
    }
}
