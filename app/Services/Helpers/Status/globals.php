<?php

if (!function_exists("errDefault")) {
    function errDefault($internalMsg = "")
    {
        error(500, "An error occurred!", $internalMsg);
    }
}
