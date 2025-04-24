<?php

namespace App\Http\Controllers;

use App\Algorithms\Component\TestingAlgo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function testing(Request $request)
    {
        $algo = new TestingAlgo();
        return $algo->testingAnotherFile();
    }
}
