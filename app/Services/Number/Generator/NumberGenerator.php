<?php

namespace App\Services\Number\Generator;

use App\Services\Number\Contract\NumberGeneratorContract;
use Illuminate\Database\Eloquent\Model;

class NumberGenerator implements NumberGeneratorContract
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }


    /**
     * @return string
     */
    public function generate()
    {
        if (!$this->model->numberPrefix) {
            errNumberGeneratorInvalid('Model get number prefix not found');
        }

        // Ex: 202201
        $number = now()->format('myd');

        // Ex: 2022010003
        $increment = $this->getIncrementNumber();
        $number .= str_pad($increment, 4, '0', STR_PAD_LEFT);

        // Ex: GX0122010003
        return strtoupper($this->model->numberPrefix . $number);
    }


    /*
     |-------------------------------------------------------------------------
     | Functions
     |-------------------------------------------------------------------------
     */

    protected function getIncrementNumber($checkMonth = true): int
    {
        try {

            return $this->model::withTrashed()
                    ->where(function ($query) use ($checkMonth) {

                        if ($checkMonth) {
                            $query->whereMonth('createdAt', now()->month);
                        }

                    })->count() + 1;

        } catch (\Exception $exception) {
            exception($exception);
        }
    }

}
