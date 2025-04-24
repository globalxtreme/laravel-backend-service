<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Model;

class ERPLocation extends Model
{
    protected $connection = 'erp';
    protected $table = 'locations';
    protected $guarded = ['id'];

}
