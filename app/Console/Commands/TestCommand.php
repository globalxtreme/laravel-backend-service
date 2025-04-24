<?php

namespace App\Console\Commands;

use App\Algorithms\Component\TestingAlgo;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'dev-test';
    protected $description = '';

    public function handle()
    {
        $algo = new TestingAlgo();
        $algo->testing();
    }
}
