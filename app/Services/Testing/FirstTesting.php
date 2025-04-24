<?php

namespace App\Services\Testing;

use App\Models\Testing\ERPBrand;
use App\Models\Testing\HRDepartment;

class FirstTesting
{
    public function create()
    {
        $brand = ERPBrand::create([
            'name' => 'Testing',
            'description' => 'Testing',
            'website' => 'https://testing.com',
        ]);

        HRDepartment::create([
            'name' => 'Testing',
            'createdAt' => now()->format('d/m/Y H:i'),
            'createdBy' => 'Testing',
            'updatedAt' => now()->format('d/m/Y H:i'),
        ]);

        return $brand;
    }
}
