<?php

namespace App\Models\Testing;

use Illuminate\Database\Eloquent\Model;

class HRDivision extends Model
{
    protected $connection = 'mysql';
    protected $table = 'divisions';
    protected $guarded = ['id'];

}
