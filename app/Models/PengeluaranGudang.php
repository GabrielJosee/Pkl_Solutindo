<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranGudang extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'product_id',
        'jumlah',
        'keterangan',
    ];

    protected $table = 'pengeluaran_gudang';

    public $timestamps = true;

    protected $primaryKey = 'pengeluaran_gudang_id';

    public function callGudang()
    {
        return $this->belongsTo(Gudang::class, 'warehouse_id');
    }
    public function callProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
