<?php

namespace App\Services\MessageBroker;

use GlobalXtreme\RabbitMQ\Models\GXRabbitMessage;
use GlobalXtreme\RabbitMQ\Queue\Contract\GXRabbitMQConsumerContract;

class TestingConsumer implements GXRabbitMQConsumerContract
{
    /**
     * The service for handle process of message
     * Please don't use try catch. For handle failed process in BaseQueueJob
     *
     * @param array|string $data
     * @return void
     */
    public static function consume(array|string $data)
    {
        // TODO: Enter your logic. Please don't use try catch
    }

}
