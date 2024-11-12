<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all()->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Created At',
        ];
    }
}
