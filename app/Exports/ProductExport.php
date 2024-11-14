<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, WithHeadings
{
    public function query()
    {
        return Product::query()
            ->with('category')
            ->select([
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

            'Title',
            'Category',
            'Mcode',
            'Karat',
            'Weight',
            'Price',
            'Compare Price',
            'Description',
            'Created At',
        ];
    }

    public function map($product): array
    {
        return [

            $product->title,
            $product->category ? $product->category->name : '',
            $product->mcode,
            $product->karat,
            $product->weight,
            $product->price,
            $product->compare_price,
            $product->description,
            $product->created_at,
        ];
    }
}
