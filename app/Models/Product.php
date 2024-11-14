<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * Relationship with JewelryModel
     */
    public function jewelryModel()
    {
        return $this->belongsTo(JewelryModel::class);
    }

    /**
     * Relationship with Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope to filter products based on query parameters
     */
    public function scopeFilter($query)
{
    if (request('title')) {
        $title = request('title');
        $query->where('title', 'LIKE', "%{$title}%");
    }
    if (request('category_name')) {
        $categoryName = request('category_name');
        $query->whereHas('category', function ($q) use ($categoryName) {
            $q->where('name', 'LIKE', "%{$categoryName}%");
        });
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
