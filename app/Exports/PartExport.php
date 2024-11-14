<?php

namespace App\Exports;

use App\Models\Part;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PartExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Part::query()
            ->with(['category', 'reseller'])
            ->select([
                'category_id',
                'name',
                'size',
                'gr_pcs',
                'dollar_gr',
                'dollar_pcs',
                'group',
                'mcode',
                'reseller_id',
                'reseller_barcode',
                'image',
                'faceted',
                'color',
                'stone_pack',
                'role',
                'thickness',
                'gr_dm',
                'created_at',
            ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Category',
            'Size',
            'Grams per Piece',
            'Dollar per Gram',
            'Dollar per Piece',
            'Group',
            'Mcode',
            'Reseller',
            'Reseller Barcode',
            'Image URL',
            'Faceted',
            'Color',
            'Stone Pack',
            'Role',
            'Thickness',
            'Grams per Dimension',
            'Created At',
        ];
    }

    public function map($part): array
    {
        return [
            $part->name,
            $part->category ? $part->category->name : '',
            $part->size,
            $part->gr_pcs,
            $part->dollar_gr,
            $part->dollar_pcs,
            $part->group,
            $part->mcode,
            $part->reseller ? $part->reseller->name : '',
            $part->reseller_barcode,
            $part->image,
            $part->faceted ? 'Yes' : 'No',
            $part->color,
            $part->stone_pack,
            $part->role ? 'Yes' : 'No',
            $part->thickness,
            $part->gr_dm,
            $part->created_at,
        ];
    }
}
