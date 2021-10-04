<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Devis;
class DevisTest extends TestCase
{
   /**@test */
   public function testEnvoyerDevis(){
       $response=$this->post('/api/sendDevis',$this->data());

   }
   private function data(){
    return [
        
        'prixpropose' => 22,
        'qte' => 2,
        'idUser' => 1,
        'idProduit' => 1,
        'couleurSouhaite' => "#fffff",
        'qtecouleur' => 2,
        'reponse' => 'null',
       
    ];
   }
  
   
public function testConsultdevis(){
    $response=$this->get('/api/devisArtisan/6');
}

}
