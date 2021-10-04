<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
class ProduitTest extends TestCase
{
   /**@test */
   public function testCreateProduct(){
       $response=$this->post('/api/addproduct',$this->data());

   }
   private function data(){
    return [
        'libelle' => 'lib1',
       'description' => 'voila le produit',
       'qte'=>1,
       'image'=>'img/xyl6EqUUIlZaTqRfXryc1sS8xY3nVIEjE0NznTDN.png',
       'prix' => 150,  
       'idCategorie' => 1,
       'idUser' => 2,
       
    ];
   }
   /**@test */
   public function testDeleteProduct(){
    
    $response=$this->delete('/api/delete/7');
   }
  
   /**@test */
   public function testUpdateProduct(){
       $response=$this->post('api/updateProduct/7',$this->data());
   }
    /**@test */
    public function testGetProduct(){
        $response=$this->get('/api/allproducts');
    }
    public function test_Get_Product_ByUser(){
        $response=$this->get('/api/allproducts/7');
    }

   

}
