<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sous_Category extends Model
{
        protected $guarded = [];

    public function category()
        {
            return $this->belongTo(Category::class);
    
        }
}
