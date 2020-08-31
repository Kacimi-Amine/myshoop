<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $guarded = [];
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function varia()
    {
        return $this->hasMany(VariableProduit::class);
    }
}
