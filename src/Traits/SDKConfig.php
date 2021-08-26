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
 * Trait SDKConfig
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Traits
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
trait SDKConfig
{
    /**
     * Function getSdkConfig
     *
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/11/2021 47:27
     */
    public function getSdkConfig()
    {
        return $this->sdkConfig;
    }

    /**
     * Function getSdkConfigOptions
     *
     * @return mixed|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/22/2021 52:28
     */
    public function getSdkConfigOptions()
    {
        if (isset($this->sdkConfig['OPTIONS'])) {
            return $this->sdkConfig['OPTIONS'];
        }

        return NULL;
    }

    /**
     * Function getSdkConfigServices
     *
     * @return mixed|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/22/2021 52:53
     */
    public function getSdkConfigServices()
    {
        if (isset($this->sdkConfig['SERVICES'])) {
            return $this->sdkConfig['SERVICES'];
        }

        return NULL;
    }

    /**
     * Function getSdkConfigPaygate
     *
     * @return mixed|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/22/2021 53:14
     */
    public function getSdkConfigPaygate()
    {
        if (isset($this->sdkConfig['PAYGATE'])) {
            return $this->sdkConfig['PAYGATE'];
        }

        return NULL;
    }

    /**
     * Function getSdkConfigShowConfirmHash
     *
     * @return mixed|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/22/2021 54:55
     */
    public function getSdkConfigShowConfirmHash()
    {
        $options = $this->getSdkConfigOptions();
        if (isset($options['showConfirmHash'])) {
            return $options['showConfirmHash'];
        }

        return NULL;
    }

    /**
     * Function setSdkConfig
     *
     * @param array $sdkConfig
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/17/2021 37:40
     */
    public function setSdkConfig(array $sdkConfig)
    {
        $this->sdkConfig = $sdkConfig;
        if (isset($this->db)) {
            $this->db->setSdkConfig($this->sdkConfig);
            $this->db->__construct($this->sdkConfig['OPTIONS']);
        }

        return $this;
    }
}
