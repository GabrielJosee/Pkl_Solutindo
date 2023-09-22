<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    use HasFactory;


    protected $fillable = [
        'stock_id',
        'product_id',
        'initial_amount',
        'adjustment_amount',
        'difference',
    ];
    protected $table = 'stock_product';
    public $timestamps = true;

    protected $primaryKey = 'stock_id';


    public function callProduct()
    {
        return $this->hasMany(Product::class, 'stock_id');
    }
}
