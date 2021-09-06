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
 * Class PayPalConstants
 *
 * @package   nguyenanhung\PayPal\UploadTracking\Services\PayPal
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class PayPalConstants
{
    const PAYPAL_REST_SANDBOX_HOSTNAME = 'https://api-m.sandbox.paypal.com';
    const PAYPAL_REST_HOSTNAME         = 'https://api-m.paypal.com';

    const TRACKING_STATUS_CANCELLED          = 'The shipment was cancelled and the tracking number no longer applies.';
    const TRACKING_STATUS_DELIVERED          = 'The item was already delivered when the tracking number was uploaded.';
    const TRACKING_STATUS_LOCAL_PICKUP       = 'Either the buyer physically picked up the item or the seller delivered the item in person without involving any couriers or postal companies.';
    const TRACKING_STATUS_ON_HOLD            = 'The item is on hold. Its shipment was temporarily stopped due to bad weather, a strike, customs, or another reason.';
    const TRACKING_STATUS_SHIPPED            = 'The item was shipped and is on the way.';
    const TRACKING_STATUS_SHIPMENT_CREATED   = 'The shipment was created.';
    const TRACKING_STATUS_DROPPED_OFF        = 'he shipment was dropped off.';
    const TRACKING_STATUS_IN_TRANSIT         = 'The shipment is in transit on its way to the buyer.';
    const TRACKING_STATUS_RETURNED           = 'The shipment was returned.';
    const TRACKING_STATUS_LABEL_PRINTED      = 'The label was printed for the shipment.';
    const TRACKING_STATUS_ERROR              = 'An error occurred with the shipment.';
    const TRACKING_STATUS_UNCONFIRMED        = 'The shipment is unconfirmed.';
    const TRACKING_STATUS_PICKUP_FAILED      = 'Pick-up failed for the shipment.';
    const TRACKING_STATUS_DELIVERY_DELAYED   = 'The delivery was delayed for the shipment.';
    const TRACKING_STATUS_DELIVERY_SCHEDULED = 'The delivery was scheduled for the shipment.';
    const TRACKING_STATUS_DELIVERY_FAILED    = 'The delivery failed for the shipment.';
    const TRACKING_STATUS_INRETURN           = 'The shipment is being returned.';
    const TRACKING_STATUS_IN_PROCESS         = 'The shipment is in process.';
    const TRACKING_STATUS_NEW                = 'The shipment is new.';
    const TRACKING_STATUS_VOID               = 'If the shipment is cancelled for any reason, its state is void.';
    const TRACKING_STATUS_PROCESSED          = 'The shipment was processed.';
    const TRACKING_STATUS_NOT_SHIPPED        = 'The shipment was not shipped.';

    const TRACKING_API_INPUT_VALIDATION_ERROR = 'Transaction ID specified is invalid.';
    const TRACKING_API_INTERNAL_SERVER_ERROR  = 'Internal server error. Please check logs for more details.';
    const TRACKING_API_NOT_AUTHORIZED         = 'Authorization failed due to insufficient permissions.';
    const TRACKING_API_RESOURCE_NOT_FOUND     = 'The specified resource does not exist.';
}
