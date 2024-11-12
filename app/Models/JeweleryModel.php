<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JeweleryModel extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}
