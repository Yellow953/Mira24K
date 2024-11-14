<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Product::query()->select([
            'category_id',
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

    public function headings(): array
    {
        return [
            'Category',
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
