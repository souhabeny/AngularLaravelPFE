<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
class UserTest extends TestCase
{
   
  
    public function testCreateUser()
   {  // $this->withoutExceptionHandling();
       $response =  $this->post('/api/signup',$this->data());
       $this->assertCount(3, User::all());
   }
    /**@test */
    public function testUpdateUser(){
        $response=$this->post('api/updateUser/',$this->data());
    }
    private function data()
    {
        return [
            'nom' => 'lp',
            'prenom' => 'dldl',
            'datenaiss'=> null,
            'adresse' => 'dkdkkd',
           
            'idGouvernerat' => '1',
            'role' => 'Client',
            'codePostal' => 2020,
            'email' => 'mm@gmail.com',
            'password' =>'12345678',
            'image'=>'img/xyl6EqUUIlZaTqRfXryc1sS8xY3nVIEjE0NznTDN.png',
         ];
    }
 /**@test */
 public function testDeleteUser(){
    
    $response=$this->delete('/api/deleteUser/1');
   }
   /**@test */
   public function test_login(){
       $response=$this->post('/api/login',$this->dataLogin());
   }
 private function dataLogin(){
    return [
        
        'email' => 'souha@gmail.com',
        'password' =>'12345678',
        
     ];
 }

}
