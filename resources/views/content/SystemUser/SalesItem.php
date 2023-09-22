<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'sales_item'; 
    protected $primaryKey   = 'sales_item_id';
    
    protected $guarded = [
        'sales_item_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
