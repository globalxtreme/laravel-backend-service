<?php

namespace App\Services\MessageBroker;

use GlobalXtreme\RabbitMQ\Models\GXRabbitAsyncWorkflow;
use GlobalXtreme\RabbitMQ\Models\GXRabbitAsyncWorkflowStep;
use GlobalXtreme\RabbitMQ\Queue\Contract\GXAsyncWorkflowConsumerContract;
use Illuminate\Support\Facades\Log;

class TestingForthTwoExecutor implements GXAsyncWorkflowConsumerContract
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
        Log::info("forth two consumer");
        Log::info($this->workflow->referenceId);
        Log::info($this->workflow->referenceType);
        Log::info($this->payload);

        $result = [
            'name' => 'Fifth message',
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
        $realData = ["success" => true, "message" => 'default'];
        if ($data) {
            $realData = $data;
        }

        return $realData;
    }

}
