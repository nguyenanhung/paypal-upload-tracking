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

/**
 * Trait PayPalServicesTrait
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Services\PayPal
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
trait PayPalServicesTrait
{
    /**
     * Function hasError
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/22/2021 31:41
     */
    public function hasError()
    {
        return $this->hasError;
    }

    /**
     * Function setHasError
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/22/2021 33:23
     */
    public function setHasError()
    {
        $this->hasError = TRUE;
    }
}
