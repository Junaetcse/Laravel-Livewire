<?php

namespace App\Models;
use App\Models\PhotoGallery;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STRIPE_PAYMENT_SUCCESS_STATUS = 'succeeded';

    protected $fillable = [
        
    ];

    public static function hasPaid($email) {
        return static::where('stripe_customer_email', trim($email))
        ->where('stripe_payment_status', static::STRIPE_PAYMENT_SUCCESS_STATUS)
        ->exists();
    }
    
    public static function cheackPaidStatus($contestant_id) {
        return static::where('contestant_id', $contestant_id)
        ->where('stripe_payment_status', static::STRIPE_PAYMENT_SUCCESS_STATUS)
        ->exists();
    }

    public static function getByEmail($email) {
        return static::where('stripe_customer_email', trim($email))->first();
    }

    public static function getCategoryCount($contestant_id){
        $cats =  static::where('contestant_id', $contestant_id)
        ->where('stripe_payment_status', static::STRIPE_PAYMENT_SUCCESS_STATUS)
        ->distinct()
        ->pluck('category_id');
        $data = [];
        foreach($cats as $k=>$v){
            $entity_count = PhotoGallery::where('contestant_id',$contestant_id)->where('category_id',$v)->get();
            array_push($data,[$v=>$entity_count->count()]);
        }
        return $data;

    }

    public static function getCategoryIds($contestant_id){
       return static::where('contestant_id', $contestant_id)
        ->where('stripe_payment_status', static::STRIPE_PAYMENT_SUCCESS_STATUS)
        ->distinct()
        ->pluck('category_id');
    }

}
