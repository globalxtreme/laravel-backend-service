<?php

namespace App\Console\Commands\MessageBroker;

use App\Services\Constant\Global\RabbitMQConstant;
use App\Services\MessageBroker\TestingConsumer;
use App\Services\MessageBroker\TestingForthExecutor;
use App\Services\MessageBroker\TestingForthOneExecutor;
use App\Services\MessageBroker\TestingForthTwoExecutor;
use App\Services\MessageBroker\TestingSecondExecutor;
use App\Services\MessageBroker\TestingThirdExecutor;
use GlobalXtreme\RabbitMQ\Constant\GXRabbitConnectionType;
use GlobalXtreme\RabbitMQ\Queue\GXAsyncWorkflowConsumer;
use GlobalXtreme\RabbitMQ\Queue\GXRabbitMQConsumer;
use Illuminate\Console\Command;

class AsyncWorkflowConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:async-workflow';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Default command for consume async workflow';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $consumer = new GXAsyncWorkflowConsumer();

        $consumer->setQueues([
            'service.customer.convert.async-workflow-1' => TestingConsumer::class,
            'service.customer.convert.async-workflow-2' => TestingSecondExecutor::class,
            'service.customer.convert.async-workflow-3' => TestingThirdExecutor::class,
            'service.customer.convert.async-workflow-4' => TestingForthExecutor::class,
            'service.customer.convert.async-workflow-4-1' => TestingForthOneExecutor::class,
            'service.customer.convert.async-workflow-4-2' => TestingForthTwoExecutor::class,
        ]);

        $this->line("\n<bg=blue>[GX-Info]</> Processing consumer for the <options=bold>[async-workflow]</> connection.\n");

        $consumer->consume();
    }
}
