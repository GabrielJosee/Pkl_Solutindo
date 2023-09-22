<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return Product::query();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kategori Produk',
            'Nama Produk',
            'Harga Produk',
            'Deskripsi Produk',
        ];
    }

    public function map($Product): array
    {
        return [
            $Product->product_id,
            $Product->productCategory->product_category_name,
            $Product->product_name,
            $Product->product_price,
            $Product->product_description,
        ];
    }
}