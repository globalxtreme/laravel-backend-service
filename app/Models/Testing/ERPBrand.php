<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Model;

class ERPBrand extends Model
{
    protected $connection = 'erp';
    protected $table = 'brands';
    protected $guarded = ['id'];
}
