<?php

if (!function_exists("auth_user")) {

    /**
     * @return array
     */
    function auth_user()
    {
        return request()->user ?: [];
    }

}
