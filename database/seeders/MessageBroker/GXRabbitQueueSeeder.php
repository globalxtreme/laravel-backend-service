<?php

namespace Database\Seeders\MessageBroker;

use App\Services\Constant\Global\GXRabbitQueueConstant;
use GlobalXtreme\RabbitMQ\Models\GXRabbitQueue;
use Illuminate\Database\Seeder;

class GXRabbitQueueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $queues = GXRabbitQueueConstant::OPTION;
        foreach ($queues as $queue) {
            if (GXRabbitQueue::ofName($queue)->count() > 0) {
                continue;
            }

            GXRabbitQueue::create([
                'name' => $queue,
                'type' => 'classic'
            ]);
        }
    }
}
