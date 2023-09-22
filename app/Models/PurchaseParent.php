<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseParent extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtotal_purchase',
        'total_purchase',
        'purchase_discount_persentage',
        'purchase_discount_value',
        'purchase_ppn_percentage',
        'purchase_ppn_value'
    ];
    protected $table = 'purchase_parent';
    public $timestamps = true;
}
