<?php

namespace App\Services\Number\Contract;

interface NumberGeneratorContract
{
    /**
     * @return string|int
     */
    public function generate();

}
