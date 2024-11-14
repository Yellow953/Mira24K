<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, WithHeadings
{
    /**
     * Query the products to export, excluding images.
     */
    public function query()
    {
        return Product::query()->select([

            'title',
            'mcode',
            'karat',
            'weight',
            'price',
            'compare_price',
            'description',
            'created_at',

        ]);
    }

    /**
     * Define the headers for the export.
     */
    public function headings(): array
    {
        return [
            'Title',
            'Mcode',
            'Karat',
            'Weight',
            'Price',
            'Compare Price',
            'Description',
            'Created At',

        ];
    }
}
