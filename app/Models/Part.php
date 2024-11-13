<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Part extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
