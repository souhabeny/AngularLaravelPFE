<?php

use Illuminate\Http\Request;

Route::group([

    'middleware' => 'api',

], function ($router) {
    //user
    Route::post('login', 'AuthController@login');
    Route::get('allusers','UserController@index');
    Route::get('deacusers','UserController@indexDeactivate');
    Route::delete('deleteUser/{id}','UserController@deleteUser');
    Route::post('signup', 'AuthController@signup');
    Route::post('signupAdmin', 'AuthController@signupAdmin');
    Route::post('sendPasswordReset', 'ResetPasswordController@sendEmail');
    Route::post('responsepasswordreset', 'ChangePasswordController@process');
    Route::get('user', 'AuthController@getAuthUser');
    Route::post('updateUser/{id}', 'AuthController@updateUser');
    Route::post('decrypt', 'AuthController@decrypt');
    //Produit
   Route::post('addproduct', 'ProduitController@addProduct');
   Route::get('allproducts','ProduitController@index');
   Route::get('allproducts/{idUser}','ProduitController@indexbyuser');
   Route::get('produitbyid/{id}','ProduitController@produitbyid');
   Route::get('produitpromo','ProduitController@produitpromo');
   Route::get('getprodbycategorie/{id}','ProduitController@getprodbycategorie');
   Route::delete('delete/{id}','ProduitController@delete');
   Route::post('updateProduct/{id}','ProduitController@updateProduct');
   Route::get('countproduitUser/{id}','ProduitController@countproduitUser');  
   Route::get('getproduitOrderByDate','ProduitController@getproduitOrderByDate'); 
  //Categorie
  Route::post('addcategorie','CategorieController@addCategorie');
  Route::get('allcategories','CategorieController@index');
  Route::delete('deleteCategorie/{id}','CategorieController@deleteCategorie');
  //Gouvernerat
  Route::post('addgouvernerat','GouverneratController@addGouvernerat');
  Route::get('allgouvernerats','GouverneratController@index');
  Route::delete('deleteGouvernerat/{id}','GouverneratController@deleteGouvernerat');
  //Commande
  Route::post('addCommande','CommandeController@addCommande');
  Route::post('addligneCommande','CommandeController@addligneCommande');
  Route::get('getcommandByUser/{id}','CommandeController@getcommandByUser');
  Route::get('getlignecommandByCommand/{idc}','CommandeController@getlignecommandByCommand'); 
  Route::get('nbAchatClient/{id}','CommandeController@nbAchatClient'); 
  Route::post('emailArtisan','CommandeController@emailArtisan');
  Route::post('emailClient','CommandeController@emailClient');
  Route::get('getProduitCommandClient/{id}','CommandeController@getProduitCommandClient');
  Route::get('getProduitCommandArtisan/{id}','CommandeController@getProduitCommandArtisan');
  Route::get('lastcommades/{id}','CommandeController@lastcommades');
  Route::get('nbcommandeArtisan/{id}','CommandeController@nbcommandeArtisan');
  //message
  Route::get('/chats','ChatsController@index');
  Route::get('/messages/{id}/{idc}','ChatsController@fetchmessages');
  Route::post('/messages','ChatsController@sendmessages');
  Route::get('/contact/{id}','ChatsController@getUsersSendMessage');

//like

Route::post('addLike/{pos}','LikeController@addlike');
Route::post('addDisLike/{posd}','LikeController@addDislike');
Route::get('countlikes/{id}','LikeController@countlikes');
Route::get('countdislikes/{id}','LikeController@countdislikes');
Route::get('existlikes/{idp}/{idu}','LikeController@existlikes');
Route::get('existdislikes/{idp}/{idu}','LikeController@existdislikes');
Route::delete('deletedislike/{idp}/{idu}','LikeController@deletedislike');
Route::delete('deletelike/{idp}/{idu}','LikeController@deletelike');
//devis
Route::post('sendDevis', 'DevisController@sendDevis');
Route::get('devisArtisan/{id}','DevisController@getDevisArtisan');
Route::post('updateDevis/{id}', 'DevisController@updateDevis');
Route::delete('deleteDevis/{id}', 'DevisController@deleteDevis');
Route::get('devisClient/{id}','DevisController@getDevisClient');
Route::post('devisClient', 'DevisController@devisClient');
Route::post('devisArtisan', 'DevisController@devisArtisan');


});
