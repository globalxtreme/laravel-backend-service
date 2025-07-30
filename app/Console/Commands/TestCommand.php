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

    private function mergeForwardPayloadToPayload($forwardPayload, &$realPayload)
    {
        if (!$forwardPayload) {
            return;
        }

        foreach ($forwardPayload ?: [] as $fKey => $fPayload) {
            if (is_array($fPayload)) {
                if (!isset($realPayload[$fKey]) || !is_array($realPayload[$fKey])) {
                    $realPayload[$fKey] = [];
                }

                $this->mergeForwardPayloadToPayload($fPayload, $realPayload[$fKey]);
            } else {
                $realPayload[$fKey] = $fPayload;
            }
        }
    }

    public function handle()
    {
//        $redis = new Redis();
//        $redis->connect('10.10.1.181', 6379);
//        $result = $redis->publish("temporary.message-broker.async-workflow.monitoring-customer.save-1", json_encode(['status' => 'native test']));
//        var_dump($result);

//        $client = Redis::connection('async-workflow')->client();
//        $client->connect(env('REDIS_ASYNC_WORKFLOW_HOST'), env('REDIS_ASYNC_WORKFLOW_PORT'));
//        dd($client->publish("ws-channel.async-workflow.monitoring:customer.save-1", json_encode([
//            "event" => "monitoring",
//            "error" => "",
//            "result" => ["status" => "success"],
//        ])));


//        $listServiceLocations[] = "sd";
//        $this->info(dechex(123456));

        $workflow = new GXAsyncWorkflowPublish(
            'customer.save',
            '1',
            'prospect_service_locations',
        );

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service-1.feature.action.async-workflow',
            'Service 1 async workflow consumer',
            [
                'name' => 'First message',
                'subs' => ['testing 1', 'testing 2', 'testing 3', 'testing 4', 'testing 5'],
            ]
        ));

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service-2.feature.action.async-workflow',
            'Service 2 async workflow consumer',
        ));

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service-3.feature.action.async-workflow',
            'Service 3 async workflow consumer',
        ));

        $workflow->onStep(new GXAsyncWorkflowForm(
            'services',
            'service-4.feature.action.async-workflow',
            'Service 4 async workflow consumer',
        ));

        $workflow->push();

//        $workflow = new GXAsyncWorkflowPublish();
//        $workflow->pushWorkflowMessage(3, 'service-1.feature.action.async-workflow', [
//                'name' => 'First message',
//                'subs' => ['testing 1', 'testing 2', 'testing 3', 'testing 4', 'testing 5'],
//            ]);

//        $consumer = TestingThirdConsumer::response(new GXRabbitAsyncWorkflowStep(), [], ['status' => true, 'message' => 'Customer response']);
//        Log::info($consumer);

//        GXRabbitMQPublish::dispatch(['message' => 'Hello World!'])
//            ->onConnection(GXRabbitConnectionType::GLOBAL)
//            ->onExchange(RabbitMQConstant::SERVICE_DOMAIN_FEATURE_ACTION_EXCHANGE)
//            ->onSender(1, "messages")
//            ->onDelivery('services');

//        $consumer = new GXRabbitMQConsumer();
//        $message = $consumer->prepareManualConsume(1644, 1);
//        $consumer->successConsuming($message, ["testing" => 'success']);
    }
}
