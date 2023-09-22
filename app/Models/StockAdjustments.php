<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockAdjustments extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'initial_amount',
        'adjustment_amount',
        'difference'
    ];
    protected $table = 'stock_adjustments';
    public $timestamps = true;

    public function callProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
