<?php
/**
 * Project paypal-upload-tracking
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 08/11/2021
 * Time: 04:12
 */

namespace nguyenanhung\PayPal\UploadTracking\Base;

use nguyenanhung\PayPal\UploadTracking\ProjectEnvironment;
use nguyenanhung\PayPal\UploadTracking\Traits\InputData;
use nguyenanhung\PayPal\UploadTracking\Traits\Response;
use nguyenanhung\PayPal\UploadTracking\Traits\SDKConfig;
use nguyenanhung\PayPal\UploadTracking\Traits\Version;

/**
 * Class BaseCore
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Base
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class BaseCore implements ProjectEnvironment
{
    use SDKConfig, Version, InputData, Response;

    const EXIT_SUCCESS            = 0; // no errors
    const EXIT_ERROR              = 1; // generic error
    const EXIT_ACCESS_DENIED      = 2; // access denied
    const EXIT_CONFIG             = 3; // configuration error
    const EXIT_UNKNOWN_FILE       = 4; // file not found
    const EXIT_UNKNOWN_CLASS      = 5; // unknown class
    const EXIT_UNKNOWN_METHOD     = 6; // unknown class member
    const EXIT_USER_INPUT         = 7; // invalid user input
    const EXIT_DATABASE           = 8; // database error
    const EXIT_UNKNOWN_REQUEST    = 9; // invalid request
    const EXIT_REDIRECT_TO_RETURN = 10; // Return to Return URL


    /** @var mixed|array SDK Config */
    protected $sdkConfig;

    /** @var mixed SDK Config Options */
    protected $options;

    /** @var mixed Input Data */
    protected $inputData;

    /** @var mixed Response Data */
    protected $response;

    /**
     * BaseCore constructor.
     *
     * @param array $options
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     */
    public function __construct(array $options = array())
    {
        $this->options = $options;
    }
}
