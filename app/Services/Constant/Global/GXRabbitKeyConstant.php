<?php

namespace App\Services\Constant\Global;

use GlobalXtreme\RabbitMQ\Constant\GXRabbitKeyConstant as GXRabbitKeyConstantPackage;

class GXRabbitKeyConstant extends GXRabbitKeyConstantPackage
{
    const MESSAGES = GXRabbitKeyConstantPackage::MESSAGES + [];
}
