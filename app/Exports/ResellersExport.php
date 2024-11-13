<?php

namespace App\Exports;

use App\Models\Reseller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResellersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Reseller::all()->map(function ($reseller) {
            return [
                'name' => $reseller->name,
                'email' => $reseller->email,
                'contact_person' => $reseller->contact_person,
                'address' => $reseller->address,
                'gsm' => $reseller->gsm,
                'phone' => $reseller->phone,
                'notes' => $reseller->notes ?? 'N/A',
                'created_at' => $reseller->created_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Contact Person',
            'Address',
            'GSM',
            'Phone',
            'Notes',
            'Created At',
        ];
    }
}

