<?php

use App\Services\Response\Constant\Error;

if (!function_exists("errDefault")) {
    function errDefault($internalMsg = "", $status = null)
    {
        error(Error::DEFAULT, $internalMsg, $status);
    }
}

if (!function_exists("errThirdPartyOpenAPIClientInvalid")) {
    function errThirdPartyOpenAPIClientInvalid($internalMsg = "", $status = null)
    {
        error(Error::GLOBAL['MESSAGE_BROKER_FAILED_NOT_FOUND'], $internalMsg, $status);
    }
}

if (!function_exists("errValidation")) {
    function errValidation($internalMsg = "")
    {
        error(Error::GLOBAL['VALIDATION'], $internalMsg, 400);
    }
}
