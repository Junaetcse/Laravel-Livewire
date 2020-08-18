<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PhotoGallery;
class Contestant extends Model
{
    protected $fillable = ['contestant_name','contestant_email'];

    public function photoGallery(){
        return $this->hasMany(PhotoGallery::class,'contestant_id');
    }

    public function shortList() {
        return $this->hasMany(PhotoGallery::class,'contestant_id')->where('shortlist','=', 1);
    }

    public function fullList() {
        return $this->hasMany(PhotoGallery::class,'contestant_id')->where('shortlist','=', 0);
    }

    public static function getContestant($name,$email)
    {
        return Contestant::where('contestant_name',$name)->where('contestant_email',$email)->first();
    }
}