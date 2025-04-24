<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Model;

class INVItemBrand extends Model
{
    protected $connection = 'inventory';
    protected $table = 'itemBrands';
    protected $guarded = ['id'];

}
