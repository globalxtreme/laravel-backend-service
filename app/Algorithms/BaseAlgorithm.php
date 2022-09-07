<?php

namespace App\Algorithms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseAlgorithm
{
    /**
     * @param Request $request
     *
     * @return mixed|JsonResponse
     */
    public static function create(Request $request)
    {
        return (new static)->handleCreate($request);
    }

    /**
     * @param Model $model
     * @param Request $request
     *
     * @return mixed|JsonResponse
     */
    public static function update(Model $model, Request $request)
    {
        return (new static)->handleUpdate($model, $request);
    }

    /**
     * @param Model $model
     *
     * @return mixed|JsonResponse
     */
    public static function delete(Model $model)
    {
        return (new static)->handleDelete($model);
    }

    abstract public function handleCreate(Request $request);

    abstract public function handleUpdate(Model $model, Request $request);

    abstract public function handleDelete(Model $model);

}
