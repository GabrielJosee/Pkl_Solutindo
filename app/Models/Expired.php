<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expired extends Model
{
    use HasFactory;

    protected $fillable= [
        'expired_id',
        'product_id',
        'product_stock',
        'expired_date'
    ];

    protected $table = 'expired';
    protected $primaryKey = 'expired_id';

}
