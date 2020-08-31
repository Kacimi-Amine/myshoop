<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    public function client()
    {
        return $this->belongTo(Client::class);

    }

    public function products()
    {
        return $this->hasMany(Commande_Produit::class);
    }

}
