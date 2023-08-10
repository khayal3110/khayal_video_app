<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'type', 
        'otp', 
    ];


    public static function saveOtp($user_id=0,$otp='',$type=''){
        UserVerify::create([
            'user_id' => $user_id,
            'type' => $type,
            'otp' => $otp 
        ]);
    }
}
