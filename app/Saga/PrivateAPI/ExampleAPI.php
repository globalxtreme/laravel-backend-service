<?php

namespace App\Saga\PrivateAPI;

use GlobalXtreme\PrivateAPI\API\PrivateAPI;

class ExampleAPI extends PrivateAPI
{
    // Service name
    const CLIENT = 'example';

    /**
     * @param $payload
     *
     * @return \Illuminate\Http\JsonResponse|null
     * @throws \GlobalXtreme\Response\Exception\ErrorException
     */
    public static function testing($payload)
    {
        return static::post('items/by-budget', $payload);
    }

    /**
     * @param $payload
     *
     * @return \Illuminate\Http\JsonResponse|null
     * @throws \GlobalXtreme\Response\Exception\ErrorException
     */
    public static function testingRollback($payload)
    {
        return static::post('testing/validation/rollback', $payload);
    }

    /**
     * @param $payload
     *
     * @return \Illuminate\Http\JsonResponse|null
     * @throws \GlobalXtreme\Response\Exception\ErrorException
     */
    public static function testingPostMultipart($payload)
    {
        return static::postMultipart('testing/validation', $payload);
    }

}
