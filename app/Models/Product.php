<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_category_id',
        'product_stock',
        'product_name',
        'product_price',
        'expired_time',
        'product_description',
    ];

    protected $table = 'core_product';
    // public $timestamps = true;

    protected $primaryKey = 'product_id';


    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function callSalesItem()
    {
        return $this->hasMany(SalesItem::class, 'product_id');
    }

    public function callStockProduct()
    {
        return $this->belongsTo(StockProduct::class, 'stock_id');
    }

    public function callPurchase()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    public function StockAdjustments()
    {
        return $this->hasMany(StockAdjustments::class, 'product_id');
    }
    public function callProductStock()
    {
        return $this->hasMany(ProductStock::class, 'product_id');
    }
    public function callPengeluaranGudang()
    {
        return $this->hasMany(PengeluaranGudang::class, 'product_id');
    }
    public function callTransferGudang()
    {
        return $this->hasMany(TransferGudang::class, 'product_id');
    }
        
}
