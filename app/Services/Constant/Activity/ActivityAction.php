<?php

namespace App\Services\Constant\Activity;

class ActivityAction
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    const OPTION = [
        self::CREATE,
        self::UPDATE,
        self::DELETE,
    ];

}
