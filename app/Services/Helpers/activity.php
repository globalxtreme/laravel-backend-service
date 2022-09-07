<?php

use App\Models\Activity\Activity;
use App\Services\Misc\SaveActivity;

if (!function_exists("activity")) {

    /**
     * @param string|null $log
     *
     * @return SaveActivity
     */
    function activity(string|null $log = null): SaveActivity
    {
        $service = new SaveActivity(new Activity);

        if ($log) {
            $service->setDescription($log);
        }

        return $service;
    }

}
