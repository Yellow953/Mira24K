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

    // Filter
    public function scopeFilter($q)
    {
        if (request('category_id')) {
            $category_id = request('category_id');
            $q->where('category_id', $category_id);
        }
        if (request('name')) {
            $name = request('name');
            $q->where('name', 'LIKE', "%{$name}%");
        }
        if (request('reseller_id')) {
            $reseller_id = request('reseller_id');
            $q->where('reseller_id', $reseller_id);
        }


        return $q;
    }
}
