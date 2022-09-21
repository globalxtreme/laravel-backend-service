<?php

namespace App\Services\Constant;

use Illuminate\Support\Str;

class BaseCodeName
{
    const OPTION = [];

    private const CAPITALS = [];


    /** --- FUNCTIONS --- */

    /**
     * @param array|null $options
     *
     * @return array
     */
    public static function get(array|null $options = null): array
    {
        if (!$options) {
            $options = static::OPTION;
        }

        $data = [];
        foreach ($options as $value) {
            $data[] = ['code' => $value, 'name' => static::display($value)];
        }

        return $data;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public static function display(string $value): string
    {
        $value = str_replace("_", " ", $value);
        $value = Str::title($value);

        foreach (self::CAPITALS as $CAPITAL) {

            $capitalTitle = Str::title($CAPITAL);
            if (stripos($value, $capitalTitle) !== false) {
                $value = str_replace($capitalTitle, $CAPITAL, $value);
            }

        }

        return $value;
    }

    /**
     * @param string $code
     *
     * @return array
     */
    public static function codeName(string $code): array
    {
        return ['code' => $code, 'name' => static::display($code)];
    }

}
