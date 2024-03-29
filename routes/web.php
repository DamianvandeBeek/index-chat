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

Route::get('/enter-room/{room_slug}', ['middleware' => 'auth', function ($room_slug) {
    
    
    $room_from_url = DB::table('rooms')->where('slug', '=', $room_slug)->get();
    
    foreach($room_from_url as $room) {
    
            $count = 0;
            $split_member = explode(" ", $room->members);
        
        foreach($split_member as $seperate_member) {
            
            if($seperate_member != Auth::user()->name) {
                $count++;
            } else {
        $all_messages = DB::table('messages')->where('room_id', '=', $room->id)->orderBy('id', 'DESC')->get();
        return view('enter_room')->with('all_messages', $all_messages)->with('room_info', $room);  
            }
            
            if ($count == count($split_member)) {
                return redirect('home');
            }
        }
    }
}]);


Route::get('/load-messages/{room_id}', ['middleware' => 'auth', function ($room_id) {
    
        $all_messages = DB::table('messages')->where('room_id', '=', $room_id)->orderBy('id', 'DESC')->get();
        return view('load_messages')->with('all_messages', $all_messages);  
    }]);


Route::post('/generate-room', 'pageController@generate_room')->name('generate_room');
Route::post('/send-message', 'pageController@send_message')->name('send_message');
Route::post('/add-user-to-room', 'pageController@add_user_to_room')->name('add_user_to_room');






