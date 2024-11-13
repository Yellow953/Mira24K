<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reseller extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    // Filter scope
    public function scopeFilter($query)
    {
        if ($name = request('name')) {
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if ($email = request('email')) {
            $query->where('email', 'LIKE', "%{$email}%");
        }
        if ($phone = request('phone')) {
            $query->where('phone', 'LIKE', "%{$phone}%");
        }
        if ($contactPerson = request('contact_person')) {
            $query->where('contact_person', 'LIKE', "%{$contactPerson}%");
        }
        if ($address = request('address')) {
            $query->where('address', 'LIKE', "%{$address}%");
        }
        if ($gsm = request('gsm')) {
            $query->where('gsm', 'LIKE', "%{$gsm}%");
        }
        if ($notes = request('notes')) {
            $query->where('notes', 'LIKE', "%{$notes}%");
        }

        return $query;
    }
}
