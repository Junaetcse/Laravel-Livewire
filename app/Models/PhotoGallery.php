<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contestant;
use App\Models\Category;

class PhotoGallery extends Model
{
    protected $fillable = ['contestant_id','category_id','file_name','file_source','shortlist'];

    public function contestant()
    {
        return $this->belongsTo(Contestant::class,'contestant_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
