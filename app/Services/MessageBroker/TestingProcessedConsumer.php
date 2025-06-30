<?php

namespace App\Services\MessageBroker;

use GlobalXtreme\RabbitMQ\Models\GXRabbitMessage;
use GlobalXtreme\RabbitMQ\Queue\Contract\GXRabbitMQConsumerContract;
use Illuminate\Support\Facades\Log;

class TestingProcessedConsumer implements GXRabbitMQConsumerContract
{
    /**
     * The service for handle process of message
     * Please don't use try catch. For handle failed process in BaseQueueJob
     *
     * @param array|string $data
     * @return array|null
     */
    public static function consume(array|string $data)
    {
        Log::info("consumer processed");
        Log::info($data);
        return [
            'testing' => 'This testing message'
        ];
    }

}
