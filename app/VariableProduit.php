<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariableProduit extends Model
{
    protected $guarded = [];
    
    public function produit()
    {
        return $this->belongsTo(Product::class);
    }
}
