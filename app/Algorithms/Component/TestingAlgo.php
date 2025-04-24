<?php

namespace App\Algorithms\Component;

use App\Models\Testing\ERPBrand;
use App\Models\Testing\ERPLocation;
use App\Models\Testing\HRDepartment;
use App\Models\Testing\HRDivision;
use App\Models\Testing\INVItemBrand;
use App\Models\Testing\INVItemCategory;
use App\Services\Testing\FirstTesting;
use App\Services\Testing\SecondTesting;
use App\Services\Testing\ThirdTesting;
use Closure;
use Illuminate\Support\Facades\DB;

class TestingAlgo
{
    public function testing()
    {
        $brand = $this->beginTransaction(['mysql', 'erp', 'inventory'], function () {

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

            ERPLocation::create([
                'name' => 'Testing',
                'description' => 'Testing',
            ]);

            INVItemBrand::create([
                'name' => 'Testing',
            ]);

            HRDivision::on('mysql')->create([
                'name' => 'Testing',
                'code' => 'TST',
            ]);

            INVItemCategory::create([
                'name' => 'Testing',
            ]);

            errOccurred();

            return $brand;
        });

        return success($brand?->only(['id', 'name']));
    }

    public function testingAnotherFile()
    {
        $brand = $this->beginTransaction(['mysql', 'erp', 'inventory'], function () {

            $first = new FirstTesting();
            $brand = $first->create();

            $second = new SecondTesting();
            $second->create();

            $third = new ThirdTesting();
            $third->create();

            return $brand;
        });

        return success($brand?->only(['id', 'name']));
    }

    public function beginTransaction(array $connections, Closure $callback)
    {
        $activeConnections = [];

        try {
            foreach ($connections as $conn) {
                DB::connection($conn)->beginTransaction();
                $activeConnections[] = $conn;
            }

            $result = $callback();

            foreach ($activeConnections as $conn) {
                DB::connection($conn)->commit();
            }
        } catch (\Error $e) {
            foreach ($activeConnections as $conn) {
                DB::connection($conn)->rollBack();
            }
            exception($e);
        }

        return $result;
    }

}
