<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelPart extends Model
{
    use SoftDeletes;

    protected $guarded = [];


    public function jewelry_model()
    {
        return $this->belongsTo(JewelryModel::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }
}
