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
 * Class PaypalREST
 *
 * @package   nguyenanhung\PHPPaygateFramework\Services\Paypal
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class PaypalREST extends BaseCore
{
    const PARTNER_IS_ON = 'on';
    const USE_IS_YES    = 'yes';

    use PaypalServicesTrait;

    protected $sandbox;
    protected $restEndpoint;
    protected $clientId;
    protected $secretId;
    protected $accessToken;
    /** @var bool $hasError */
    protected $hasError = FALSE;

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
    public function setSandbox($sandbox = FALSE)
    {
        $this->sandbox = $sandbox;
        if ($this->sandbox === TRUE) {
            $this->restEndpoint = PaypalConstants::PAYPAL_REST_SANDBOX_HOSTNAME;
        } else {
            $this->restEndpoint = PaypalConstants::PAYPAL_REST_HOSTNAME;
        }

        return $this;
    }

    /**
     * Function getSandbox
     *
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 41:45
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
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 14:22
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
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 41:53
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
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 42:02
     */
    public function getSecretId()
    {
        return $this->secretId;
    }

    /**
     * Function getAccessToken
     *
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 46:14
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
        if ($this->sandbox === TRUE) {
            $url = PaypalConstants::PAYPAL_REST_SANDBOX_HOSTNAME . '/v1/oauth2/token';
        } else {
            $url = PaypalConstants::PAYPAL_REST_HOSTNAME . '/v1/oauth2/token';
        }
        $params = ['grant_type' => 'client_credentials'];
        $curl   = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->setOpt(CURLOPT_ENCODING, "utf-8");
        $curl->setOpt(CURLOPT_MAXREDIRS, 10);
        $curl->setOpt(CURLOPT_TIMEOUT, 60);
        $curl->setBasicAuthentication($this->clientId, $this->secretId);
        $curl->post($url, $params);
        // Response
        $result = $curl->error ? "cURL Error: " . $curl->errorMessage : $curl->response;
        // Close Request
        $curl->close();
        $res = json_decode($result);
        if (isset($res->access_token)) {
            $this->accessToken = $res->access_token;
        } else {
            $this->accessToken = NULL;
        }

        return $this;
    }

    /**
     * Function sendRequest
     *
     * @param string $url
     * @param array  $data
     * @param string $method
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/24/2021 01:59
     */
    public function sendRequest($url = '', $data = array(), $method = 'JSON')
    {
        $getMethod = strtoupper($method);
        // Curl
        $curl = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->setOpt(CURLOPT_ENCODING, "utf-8");
        $curl->setOpt(CURLOPT_MAXREDIRS, 10);
        $curl->setOpt(CURLOPT_TIMEOUT, 60);
        // Request
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
        // Response
        $response = $curl->error ? "cURL Error: " . $curl->errorMessage : $curl->response;
        // Close Request
        $curl->close();

        // Return Response
        return [
            "response"       => $response,
            "httpStatusCode" => $curl->httpStatusCode
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
