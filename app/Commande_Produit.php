<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande_Produit extends Model
{
    public function commande()
    {
        return $this->belongTo(Commande::class);

    }
}
