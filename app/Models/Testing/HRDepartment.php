<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Model;

class HRDepartment extends Model
{
    protected $connection = 'mysql';
    protected $table = 'departments';
    protected $guarded = ['id'];

}
