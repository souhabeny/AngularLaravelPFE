<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Commande;
class CommandTest extends TestCase
{
   /**@test */
   public function testvaliderCommand(){
       $response=$this->post('/api/addCommande',$this->data());

   }
   private function data(){
    return [
        
       'iduser' => 6,
       
    ];
   }
   public function testvaliderligneCommand(){
    $response=$this->post('/api/addligneCommande',$this->data2());

}
private function data2(){
 return [
     
    'qtecommande' => 6,
    'idCommande' => 6,
    'idProduit' => 6,
    
 ];
}
   
public function testConsultproduct(){
    $response=$this->get('/api/getProduitCommandClient/6');
}

}
