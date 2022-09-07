<?php

use App\Services\Response\Constant\Error;

if (!function_exists("errDefault")) {
    function errDefault($internalMsg = "", $status = null)
    {
        error(Error::DEFAULT, $internalMsg, $status);
    }
}
