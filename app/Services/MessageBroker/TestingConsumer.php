<?php

namespace App\Services\MessageBroker;

use GlobalXtreme\RabbitMQ\Models\GXRabbitAsyncWorkflow;
use GlobalXtreme\RabbitMQ\Models\GXRabbitAsyncWorkflowStep;
use GlobalXtreme\RabbitMQ\Queue\Contract\GXAsyncWorkflowConsumerContract;
use GlobalXtreme\RabbitMQ\Queue\Contract\GXAsyncWorkflowForwardPayload;
use Illuminate\Support\Facades\Log;

class TestingConsumer implements GXAsyncWorkflowConsumerContract, GXAsyncWorkflowForwardPayload
{
    /**
     * @param GXRabbitAsyncWorkflow $workflow
     * @param GXRabbitAsyncWorkflowStep $workflowStep
     * @param array $payload
     */
    public function __construct(protected GXRabbitAsyncWorkflow     $workflow,
                                protected GXRabbitAsyncWorkflowStep $workflowStep,
                                protected array                     $payload)
    {
    }


    /**
     * @return array|null
     */
    public function consume()
    {
        Log::info("first consumer");
        Log::info($this->workflow->referenceId);
        Log::info($this->workflow->referenceType);
        Log::info($this->payload);

        $result = [
            'name' => 'Second message',
            'subs' => ['testing 1', 'testing 2', 'testing 3', 'testing 4', 'testing 5'],
        ];

        return self::response($result);
    }

    /**
     * @param $data
     *
     * @return array|mixed
     */
    public function response($data = null)
    {
        Log::info("consumer response testing first step");
        $realData = ["success" => true, "message" => 'default'];
        if ($data) {
            $realData = $data;
        }

        return $realData;
    }

    /**
     * @return array
     */
    public function forwardPayload()
    {
        return [
            'service.customer.convert.async-workflow-3' => [
                'action' => 'testing forward message for step 3'
            ],
            'service.customer.convert.async-workflow-4' => [
                'action' => 'testing forward message for step 4',
                'status' => [
                    'id' => 1,
                    'name' => 'testing',
                    'types' => ['type 1', 'type 2'],
                ]
            ],
        ];
    }
}
