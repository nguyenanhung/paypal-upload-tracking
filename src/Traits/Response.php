<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/11/2021
 * Time: 04:12
 */

namespace nguyenanhung\PayPal\UploadTracking\Traits;

/**
 * Trait Response
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Traits
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 *
 * @property null|object|array|mixed response
 * @property bool|null|mixed         responseIsObject
 * @property bool|null|mixed         responseIsJson
 * @property bool|null|mixed         responseIsUssdText
 */
trait Response
{
    /**
     * Function setResponseIsObject
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/11/2021 49:08
     */
    public function setResponseIsObject()
    {
        $this->responseIsObject = TRUE;

        return $this;
    }

    /**
     * Function setResponseIsJson
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/11/2021 49:11
     */
    public function setResponseIsJson()
    {
        $this->responseIsJson = TRUE;

        return $this;
    }

    /**
     * Function getResponse
     *
     * @return array|mixed|object|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/11/2021 49:13
     */
    public function getResponse()
    {
        if ($this->responseIsJson === TRUE) {
            return json_encode($this->response);
        }

        return $this->response;
    }

    /**
     * Function toJson
     *
     * @return false|string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/11/2021 48:58
     */
    public function toJson()
    {
        return json_encode($this->response);
    }
}
