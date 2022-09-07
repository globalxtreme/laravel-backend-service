<?php

namespace App\Algorithms\Component\Support;

use App\Algorithms\BaseAlgorithm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class ComponentBaseAlgorithm extends BaseAlgorithm
{
    /**
     * @param Request $request
     *
     * @return void
     */
    public function handleCreate(Request $request)
    {
        //
    }


    /** --- NEW FUNCTIONS --- */

    /**
     * @param $model
     * @param Request $request
     *
     * @return mixed|JsonResponse
     */
    public static function createBy($model, Request $request)
    {
        return (new static)->handleCreateBy($model, $request);
    }

    abstract public function handleCreateBy($model, Request $request);

}
