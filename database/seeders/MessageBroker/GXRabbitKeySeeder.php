<?php

namespace Database\Seeders\MessageBroker;

use App\Services\Constant\Global\GXRabbitKeyConstant;
use GlobalXtreme\RabbitMQ\Models\GXRabbitKey;
use GlobalXtreme\RabbitMQ\Models\GXRabbitQueue;
use Illuminate\Database\Seeder;

class GXRabbitKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queue = GXRabbitQueue::ofName(config('queue.connections.rabbitmq.queue'))->first();

        $messages = GXRabbitKeyConstant::MESSAGES;
        foreach ($messages as $key => $message) {

            if ($key == GXRabbitKeyConstant::FAILED_SAVE) {
                continue;
            }

            $rabbitKey = GXRabbitKey::ofName($key)->ofQueueId($queue->id)->first();
            if ($rabbitKey) {
                $rabbitKey->class = $message;
                $rabbitKey->save();
                continue;
            }

            GXRabbitKey::create([
                'queueId' => $queue->id,
                'name' => $key,
                'class' => $message
            ]);
        }
    }
}
