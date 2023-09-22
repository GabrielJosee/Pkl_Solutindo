<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_parent_id',
        'supplier_name',
        'product_id',
        'purchase_amount',
        'purchase_price',
        'purchase_discount'
    ];
    protected $table = 'purchase';
    public $timestamps = true;

    // protected $primaryKey = 'purchase_id';

    public function callProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
