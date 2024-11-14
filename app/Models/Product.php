<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function jewelryModel()
    {
        return $this->belongsTo(JewelryModel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query)
    {
        if (request('title')) {
            $title = request('title');
            $query->where('title', 'LIKE', "%{$title}%");
        }
        if (request('mcode')) {
            $mcode = request('mcode');
            $query->where('mcode', 'LIKE', "%{$mcode}%");
        }
        if (request('karat')) {
            $karat = request('karat');
            $query->where('karat', $karat);
        }
        if (request('weight')) {
            $weight = request('weight');
            $query->where('weight', $weight);
        }
        if (request('category_id')) {
            $category_id = request('category_id');
            $query->where('category_id', $category_id);
        }
        if (request('description')) {
            $description = request('description');
            $query->where('description', 'LIKE', "%{$description}%");
        }
        if (request('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }
        if (request('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        return $query;
    }
}
