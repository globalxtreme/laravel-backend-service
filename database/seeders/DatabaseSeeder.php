<?php

namespace Database\Seeders;

use Database\Seeders\MessageBroker\GXRabbitKeySeeder;
use Database\Seeders\MessageBroker\GXRabbitQueueSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            // MESSAGE BROKER
            GXRabbitQueueSeeder::class,
            GXRabbitKeySeeder::class,

        ]);
    }
}
