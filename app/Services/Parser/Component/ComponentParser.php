<?php

namespace App\Services\Parser\Component;

use GlobalXtreme\Parser\BaseParser;

class ComponentParser extends BaseParser
{
    /**
     * @param $data
     *
     * @return array|null
     */
    public static function first($data)
    {
        if (!$data) {
            return null;
        }

        return $data->only('id', 'name') + [
                'createdAt' => $data->createdAt?->format('d/m/Y H:i')
            ];
    }

}
