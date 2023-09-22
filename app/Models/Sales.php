<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'sales_parent_id',
        'sales_no',
        'customer_id',
        'sales_date',
        'sales_remark',
        'vouchers_id',
        'vouchers_nominal'
    ];
    protected $table = 'sales';
    public $timestamps = true;

    protected $primaryKey = 'sales_id';

    public function callCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function callVoucher()
    {
        return $this->belongsTo(Vouchers::class, 'vouchers_id');
    }

    public function callSalesItem()
    {
        return $this->belongsTo(SalesItem::class, 'sales_id');
    }

    public function callSalesItemTok()
    {
        return $this->hasMany(SalesItem::class, 'sales_id');
    }
}
