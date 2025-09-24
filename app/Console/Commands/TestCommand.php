<?php

namespace App\Console\Commands;

use App\Services\Constant\Global\RabbitMQConstant;
use App\Services\MessageBroker\TestingThirdConsumer;
use Carbon\Carbon;
use GlobalXtreme\RabbitMQ\Constant\GXRabbitConnectionType;
use GlobalXtreme\RabbitMQ\Form\GXAsyncWorkflowForm;
use GlobalXtreme\RabbitMQ\Models\GXRabbitAsyncWorkflowStep;
use GlobalXtreme\RabbitMQ\Queue\GXAsyncWorkflowPublish;
use GlobalXtreme\RabbitMQ\Queue\GXRabbitMQConsumer;
use GlobalXtreme\RabbitMQ\Queue\GXRabbitMQPublish;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TestCommand extends Command
{
    protected $signature = 'dev-test';
    protected $description = '';

    public function handle()
    {
        $workflow = new GXAsyncWorkflowPublish(
            'customer.save',
            '1',
            'prospect_service_locations',
        );
        $workflow->setCreatedBy("ec088108-cb01-43b8-9e86-9c6236e45a20", "Yuswa");
        $workflow->setDescription("Testing rabbitmq php description");
        $workflow->setSuccessMessage("Testing php rabbitmq success message");
        $workflow->seterrorMessage("Testing php rabbitmq error message");

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service.customer.convert.async-workflow-1',
            'Service 1 async workflow consumer',
            [
                'name' => 'First message',
                'subs' => ['testing 1', 'testing 2', 'testing 3', 'testing 4', 'testing 5'],
            ]
        ));

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service.customer.convert.async-workflow-2',
            'Service 2 async workflow consumer',
        ));

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service.customer.convert.async-workflow-3',
            'Service 3 async workflow consumer',
        ));

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service.customer.convert.async-workflow-4',
            'Service 4 async workflow consumer'
        ));

        $workflow->push();
    }
}
