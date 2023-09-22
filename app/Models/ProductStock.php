<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'purchase_no',
        'stock',
        'expired_time',
        'expired_date'
    ];
    protected $table = 'product_stock';
    public $timestamps = true;

    public function callProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function callGudang()
    {
        return $this->belongsTo(Gudang::class, 'warehouse_id');
    }
}
