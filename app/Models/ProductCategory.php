<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id',
        'product_category_code',
        'product_category_name',
    ];
    protected $table = 'core_product_category';

    protected $primaryKey = 'product_category_id';
    // public $timestamps = true;

    public function product()
    {
        return $this->hasMany(Product::class,'product_category_id');
    }
}
