<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferGudang extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'required_amount',
        'destination_warehouse'
    ];
    protected $table = 'warehouse_transfer';
    public $timestamps = true;

    protected $primaryKey = 'warehouse_transfer_id';

    public function callGudang()
    {
        return $this->belongsTo(Gudang::class, 'warehouse_id');
    }

    public function callGudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'warehouse_id');
    }

    public function callProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}