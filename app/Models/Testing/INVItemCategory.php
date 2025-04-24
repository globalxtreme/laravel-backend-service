<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Model;

class INVItemCategory extends Model
{
    protected $connection = 'inventory';
    protected $table = 'itemCategories';
    protected $guarded = ['id'];

}
