<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_register_date',
        'customer_gender',
        'customer_age',
        'customer_phone'
    ];
    protected $table = 'core_customer';
    public $timestamps = true;

    protected $primaryKey = 'customer_id';

    public function callSales()
    {
        return $this->hasMany(Sales::class, 'customer_id');
    }
}
