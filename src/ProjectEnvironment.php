<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/11/2021
 * Time: 04:12
 */

namespace nguyenanhung\PayPal\UploadTracking;

/**
 * Interface ProjectEnvironment
 *
 * @package   nguyenanhung\PayPal\UploadTracking
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
interface ProjectEnvironment
{
    const VERSION      = '1.0.4';
    const AUTHOR_NAME  = 'Hung Nguyen';
    const AUTHOR_EMAIL = 'dev@nguyenanhung.com';
    const AUTHOR_URL   = 'https://nguyenanhung.com';

    /**
     * Function getVersion
     *
     * @return mixed
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 08/11/2021 41:29
     */
    public function getVersion();
}
