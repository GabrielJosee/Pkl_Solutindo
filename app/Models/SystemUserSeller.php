<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemUserSeller extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'system_user_seller'; 
    protected $primaryKey   = 'seller_id';
    
    protected $guarded = [
        'seller_id',
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
