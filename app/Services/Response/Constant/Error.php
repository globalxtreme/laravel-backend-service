<?php

namespace App\Services\Response\Constant;

use GlobalXtreme\Response\Constant\ResponseConstant;

class Error extends ResponseConstant
{
    /** --- DEFAULT --- */
    const DEFAULT = ['code' => 'ERR0000', 'msg' => 'Process is failed'];

    /** --- GLOBAL --- */
    public const GLOBAL = ResponseConstant::GLOBAL + [
        'THIRD_PARTY_OPEN_API_CLIENT_INVALID' => [
            'code' => 'GL0010',
            'msg' => 'Open API client invalid'
        ],
    ];

}
