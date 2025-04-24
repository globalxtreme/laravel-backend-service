<?php

namespace App\Services\Testing;

use App\Models\Testing\ERPBrand;
use App\Models\Testing\ERPLocation;
use App\Models\Testing\HRDepartment;
use App\Models\Testing\INVItemBrand;

class SecondTesting
{
    public function create()
    {
        ERPLocation::create([
            'name' => 'Testing',
            'description' => 'Testing',
        ]);

        INVItemBrand::create([
            'name' => 'Testing',
        ]);
    }
}
