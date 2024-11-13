<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reseller extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'gsm',
        'phone',
        'email',
        'contact_person',
        'notes',
    ];

    // Filter scope
    public function scopeFilter($query)
    {
        if ($name = request('name')) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        if ($email = request('email')) {
            $query->where('email', 'LIKE', "%{$email}%");
        }

        if ($contactPerson = request('contact_person')) {
            $query->where('contact_person', 'LIKE', "%{$contactPerson}%");
        }

        return $query;
    }
}
