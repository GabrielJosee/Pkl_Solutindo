<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'warehouse_name',
        'address',
        'warehouse_responsible_name',
        'number_phone',
    ];

    protected $table = 'warehouse';
    public $timestamps = true;

    protected $primaryKey = 'warehouse_id';

    public function callTransferGudang()
    {
        return $this->hasMany(callTransferGudang::class, 'warehouse_id');
    }
    public function callPengeluaranGudang()
    {
        return $this->hasMany(PengeluaranGudang::class, 'warehouse_id');
    }
    public function callPengeluaranGudangTujuan()
    {
        return $this->hasMany(TransferGudang::class, 'warehouse_transfer_id');
    }
    
    public function callSalesItem()
    {
        return $this->hasMany(SalesItem::class, 'warehouse_id');
    }
}
