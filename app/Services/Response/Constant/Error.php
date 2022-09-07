<?php

namespace App\Services\Response\Constant;

use GlobalXtreme\Response\Constant\ResponseConstant;

class Error extends ResponseConstant
{
    /** --- DEFAULT --- */
    const DEFAULT = ['code' => 'ERR0000', 'msg' => 'Process is failed'];
}
