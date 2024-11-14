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

    public function scopeFilter($q)
{
    if (request('category_id')) {
        $q->where('category_id', request('category_id'));
    }
    if (request('name')) {
        $q->where('name', 'LIKE', '%' . request('name') . '%');
    }
    if (request('reseller_id')) {
        $q->where('reseller_id', request('reseller_id'));
    }
    if (request('size')) {
        $q->where('size', request('size'));
    }
    if (request('color')) {
        $q->where('color', request('color'));
    }
    if (request('faceted') !== null) {
        $q->where('faceted', request('faceted'));
    }
    if (request('group')) {
        $q->where('group', 'LIKE', '%' . request('group') . '%');
    }
    if (request('thickness_min') && request('thickness_max')) {
        $q->whereBetween('thickness', [request('thickness_min'), request('thickness_max')]);
    }

    return $q;
}

}
