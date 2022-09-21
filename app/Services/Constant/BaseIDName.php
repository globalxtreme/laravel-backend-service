<?php

namespace App\Services\Constant;

class BaseIDName
{
    const UNKNOWN = 'unknown';

    const OPTION = [
        0 => self::UNKNOWN
    ];


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
        foreach ($options as $key => $value) {
            $data[] = ['id' => $key, 'name' => $value];
        }

        return $data;
    }

    /**
     * @param int $id
     *
     * @return string
     */
    public static function display(int $id): string
    {
        return static::OPTION[$id];
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public static function idName(int $id): array
    {
        return ['id' => $id, 'name' => static::OPTION[$id]];
    }

}
