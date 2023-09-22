<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    use HasFactory;
    protected $fillable = [
        'vouchers_id',
        'vouchers_name',
        'start_date',
        'end_date',
        'nominal'
    ];
    protected $table = 'vouchers';
    public $timestamps = true;

    protected $primaryKey = 'vouchers_id';

    public function callSales()
    {
        return $this->hasMany(Sales::class, 'vouchers_id');
    }
}
