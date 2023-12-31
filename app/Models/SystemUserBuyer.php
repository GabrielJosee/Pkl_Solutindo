<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemUserBuyer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'system_user_buyer'; 
    protected $primaryKey   = 'buyer_id';
    
    protected $guarded = [
        'buyer_id',
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
