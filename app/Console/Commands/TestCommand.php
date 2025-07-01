<?php

namespace App\Console\Commands;

use App\Services\Constant\Global\RabbitMQConstant;
use Carbon\Carbon;
use GlobalXtreme\RabbitMQ\Constant\GXRabbitConnectionType;
use GlobalXtreme\RabbitMQ\Queue\GXRabbitMQConsumer;
use GlobalXtreme\RabbitMQ\Queue\GXRabbitMQPublish;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'dev-test';
    protected $description = '';

    public function handle()
    {
        GXRabbitMQPublish::dispatch(['message' => 'Hello World!'])
            ->onConnection(GXRabbitConnectionType::GLOBAL)
            ->onExchange(RabbitMQConstant::SERVICE_DOMAIN_FEATURE_ACTION_EXCHANGE)
            ->onSender(1, "messages")
            ->onDelivery('services');

//        $consumer = new GXRabbitMQConsumer();
//        $message = $consumer->prepareManualConsume(1644, 1);
//        $consumer->successConsuming($message, ["testing" => 'success']);
    }
}
