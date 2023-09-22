<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesParent extends Model
{
    use HasFactory;
    protected $fillable = [
        'subtotal_sales',
        'total_sales',
        'sales_discount_persentage',
        'sales_discount_value',
        'sales_ppn_percentage',
        'sales_ppn_value'
    ];
    protected $table = 'sales_parent';
    public $timestamps = true;
}
