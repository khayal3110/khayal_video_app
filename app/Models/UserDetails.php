<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'profile_icon', 
        'is_email_verified', 
        'is_phone_verified', 
        'phone_code', 
        'address',
        'city',
        'zipcode',
        'state',
        'country',
        'credit',
        'wallet_amount',
        'referral_id',
        
    ];

    public static function saveUserDetails($user_details){
        $user_id = $user_details['user_id'];
        
        $details = UserDetails::where('user_id', $user_id)->first();
        if(empty($details)){
            UserDetails::updateOrCreate([
                    'user_id' => $user_id,
                    'profile_icon' => (isset($user_details['profile_icon']) ? $user_details['profile_icon'] : ''),

                    'is_email_verified' => (isset($user_details['is_email_verified']) ? $user_details['is_email_verified'] : '0'),

                    'is_phone_verified' => (isset($user_details['is_phone_verified']) ? $user_details['is_phone_verified'] : '0'),

                    'phone_code' => (isset($user_details['phone_code']) ? $user_details['phone_code'] : ''),
                     
                    'address' => (isset($user_details['address']) ? $user_details['address'] : ''),
                    'zipcode' => (isset($user_details['zipcode']) ? $user_details['zipcode'] : ''),
                    'city' => (isset($user_details['city']) ? $user_details['city'] : ''),
                    'state' => (isset($user_details['state']) ? $user_details['state'] : ''),
                    'country' => (isset($user_details['country']) ? $user_details['country'] : ''),
                    'credit' => (isset($user_details['credit']) ? $user_details['credit'] : '5'),
                    'wallet_amount' => (isset($user_details['wallet_amount']) ? $user_details['wallet_amount'] : '0'),
                    'referral_id' => (isset($user_details['referral_id']) ? $user_details['referral_id'] : '0'),
                    
                    
                ]
            );
        }
        else{
            UserDetails::where('user_id', '=', $user_id)->update($user_details);
        }
        return $details ? true : false;
    }
   
}
