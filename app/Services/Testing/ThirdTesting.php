<?php

namespace App\Services\Testing;

use App\Models\Testing\ERPBrand;
use App\Models\Testing\HRDepartment;
use App\Models\Testing\HRDivision;
use App\Models\Testing\INVItemCategory;

class ThirdTesting
{
    public function create()
    {
        HRDivision::on('mysql')->create([
            'name' => 'Testing',
            'code' => 'TST',
        ]);

        INVItemCategory::create([
            'name' => 'Testing',
        ]);

        // Test Error
        errOccurred();
    }
}
