<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category','sequence'];

    public const CATEGORIES = [
        'art'
        ,'photo'
        ,'both_art_and_photo'
    ]; 

    public static function findIdByName($name) {
        return static::where('category', $name)->value('id');
    }
}
