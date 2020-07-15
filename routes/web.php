<?php

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
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin', ['middleware' => 'auth', 'uses' => 'pageController@admin'])->name('admin');
Route::get('/make-chatroom', ['middleware' => 'auth', 'uses' => 'pageController@make_chatroom'])->name('make_chatroom');
Route::get('/your-rooms', ['middleware' => 'auth', 'uses' => 'pageController@your_rooms'])->name('your_rooms');
Route::get('/url-already-exist', ['middleware' => 'auth', 'uses' => 'pageController@slug_already_exist'])->name('slug_already_exist');


Route::get('/enter-room/{room_slug}', ['middleware' => 'auth', function ($room_slug) {
    
    
    $room_from_url = DB::table('rooms')->where('slug', '=', $room_slug)->get();
    
    foreach($room_from_url as $room) {
    
    $split_member = explode(" ", $room->members);
        
        foreach($split_member as $seperate_member) {
            
            if($seperate_member == Auth::user()->name) {
                
        $all_messages = DB::table('messages')->where('room_id', '=', $room->id)->orderBy('id', 'DESC')->get();
        return view('enter_room')->with('all_messages', $all_messages)->with('room_info', $room);
                
            } else {
                return redirect('home');
            }
            
            
        }
        
  
    }
}]);



Route::post('/generate-room', 'pageController@generate_room')->name('generate_room');
Route::post('/send-message', 'pageController@send_message')->name('send_message');
Route::post('/add-user-to-room', 'pageController@add_user_to_room')->name('add_user_to_room');






