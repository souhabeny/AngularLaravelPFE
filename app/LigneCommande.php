<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    protected $fillable = [ 'qtecommande','adresselivraison', 'idCommande','idProduit'];
}
