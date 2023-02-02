<?php

use Illuminate\Support\Str;

if (!function_exists("auth_employee")) {

    /**
     * @return array|null
     */
    function auth_employee()
    {
        return request()->employee ?: null;
    }

}

if (!function_exists("auth_customer")) {

    /**
     * @return array|null
     */
    function auth_customer()
    {
        return request()->customer ?: null;
    }

}

if (!function_exists("service_locations")) {

    /**
     * @return array|null
     */
    function service_locations()
    {
        $customer = request()->customer;
        if (!$customer) {
            return null;
        }

        return isset($customer['serviceLocations']) ?
            (count($customer['serviceLocations']) > 0 ? $customer['serviceLocations'] : null) :
            null;
    }

}

if (!function_exists("service_location")) {

    /**
     * @param $uuid
     *
     * @return mixed|TValue|null
     */
    function service_location($uuid)
    {
        $serviceLocations = service_locations();
        if (!$serviceLocations) {
            return null;
        }

        return collect($serviceLocations)->where('uuid', $uuid)->first();
    }

}

if (!function_exists("auth_company_office")) {

    /**
     * @return array|null
     */
    function auth_company_office()
    {
        return request()->companyOffice ?: null;
    }

}

if (!function_exists("auth_created_by")) {

    /**
     * @return array
     */
    function auth_created_by()
    {
        $employee = auth_employee();
        if ($employee) {
            return [
                'createdBy' => $employee['id'],
                'createdByName' => $employee['fullName'],
            ];
        }

        $customer = auth_customer();
        if ($customer) {
            return [
                'createdBy' => $customer['uuid'],
                'createdByName' => $customer['holderName'],
            ];
        }

        return [];
    }

}

if (!function_exists('filename')) {

    /**
     * @param $file
     * @param $text
     * @param $keyId
     * @param string|null $extension
     *
     * @return string
     */
    function filename($file, $text, $keyId = null, string|null $extension = null): string
    {
        return ($keyId ? "$keyId-" : "") . Str::random(20) . str_shuffle(str_replace(' ', '', $text)) . '.' . ($extension ?: $file->getClientOriginalExtension());
    }

}

if (!function_exists("has_permission_to")) {

    /**
     * @param string $name
     *
     * @return bool
     */
    function has_permission_to(string $name): bool
    {
        $employee = auth_employee();
        if (!$employee) {
            return false;
        }

        if (!isset($employee['permissions']) || !is_array($employee['permissions'])) {
            return false;
        }

        $permissions = $employee['permissions'];
        if (!isset($permissions[$name])) {
            return false;
        }

        return $permissions[$name];
    }

}

if (!function_exists("has_role_to")) {

    /**
     * @param string $name
     *
     * @return bool
     */
    function has_role_to(string $name): bool
    {
        $employee = auth_employee();
        if (!$employee) {
            return false;
        }

        if (!isset($employee['roles']) || !is_array($employee['roles'])) {
            return false;
        }

        $roles = $employee['roles'];
        if (!isset($roles[$name])) {
            return false;
        }

        return $roles[$name];
    }

}

if (!function_exists('convert_string_to_array')) {

    /**
     * @param string|array|null $values
     *
     * @return array
     */
    function convert_string_to_array(string|array|null $values = null): array
    {
        if (!$values) {
            return [];
        }

        if (is_array($values)) {
            return $values;
        }

        $values = preg_replace('/[^A-Za-z0-9\-]/', ' ', $values);
        $values = preg_replace('/\s+/', ' ', $values);

        $values = explode(" ", $values);
        return collect($values)->filter(function ($value) {
            return $value;
        })->values()->toArray();
    }

}

if (!function_exists("snake_to_camel_case")) {

    /**
     * @param string $text
     *
     * @return string
     */
    function snake_to_camel_case(string $text)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $text))));
    }

}

if (!function_exists("validate_latitude")) {

    /**
     * @param float|int|string $latitude
     *
     * @return bool `true` if $lat is valid, `false` if not
     */
    function validate_latitude(float|int|string $latitude)
    {
        $latitude = number_format((float)$latitude, 6);
        return preg_match('/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/', $latitude);
    }

}

if (!function_exists("validate_longitude")) {

    /**
     * @param float|int|string $longitude
     *
     * @return bool `true` if $long is valid, `false` if not
     */
    function validate_longitude(float|int|string $longitude)
    {
        $longitude = number_format((float)$longitude, 6);
        return preg_match('/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/', $longitude);
    }

}

if (!function_exists("alphabet_from_number")) {

    /**
     * @param float|int|string $number
     *
     * @return bool `true` if $long is valid, `false` if not
     */
    function alphabet_from_number($number, $less = 0)
    {
        // Set default start number
        $defaultNumber = 0;

        $alphabet = 'A';
        for ($i = $alphabet; $defaultNumber <= $number; $i++) {
            if ($defaultNumber == ($number - $less)) {
                return $i;
            }
            $defaultNumber++;
        }
        return null;
    }

}

if (!function_exists("storage_link")) {

    /**
     * @param string $path
     *
     * @return string
     */
    function storage_link(string $path)
    {
        if (!$path) {
            return null;
        }

        return config('base.conf.storage-link') . $path;
    }

}
