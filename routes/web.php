<?php
use App\Events\websocketDemoEvent;
use App\Events\MessageSent;
use App\Events\Event;
use App\Message;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  //  broadcast(new Event());
    return view('welcome');
});
Route::get('/messages', function () {
  //  broadcast(new Event());
    return view('chats');
});
/*Route::post('/send', function () {
    
    //return view('chats');
});*/
Route::get('/fire', function () {
  event(new \App\Events\Event("memem"));
  
  return 'ok';
});
//Route::get('/chats','ChatsController@index');
//Route::get('/messages','ChatsController@fetchmessages');

//Route::post('/messages/{id}','ChatsController@sendmessages');
Route::post('/send','ChatsController@sendmessages');