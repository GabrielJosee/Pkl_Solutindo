<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sales_id',
        'sales_parent_id',
        'product_id',
        'warehouse_id',
        'sales_item_price',
        'sales_item_amount',
        'sales_item_total_price',
        'sales_discount'
    ];
    protected $table = 'sales_item';
    public $timestamps = true;

    protected $primaryKey = 'sales_item_id';

    public function callProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function callSales()
    {
        return $this->hasMany(Sales::class,'sales_id');
    }
    
    public function callSalesTok()
    {
        return $this->belongsTo(Sales::class,'sales_id');
    }
    
    public function callGudang()
    {
        return $this->belongsTo(Gudang::class,'warehouse_id');
    }
    
}
