<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function jewelry_model()
    {
        return $this->belongsTo(JewelryModel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
