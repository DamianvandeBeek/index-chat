<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use App\User;

class pageController extends Controller
{
    public function admin() {
        $user = Auth::user()->name;
         $is_admin = DB::table('users')->where('name', $user)->pluck('is_admin');
           
        if($is_admin[0] == true) {
            return view('admin');
        } else {
            return redirect ('home');
        } 
    }
    
    public function make_chatroom() {
        return view('make_chatroom');
    }
    public function slug_already_exist() {
        return view('slug_already_exist');
    }
    
    
    public function your_rooms() {
        $all_rooms = DB::table('rooms')->get();
        $room_names = array();
        
       foreach($all_rooms as $room) {
             $split_member = explode(" ", $room->members);
           foreach($split_member as $member) {
               if ($member == Auth::user()->name) {
                   array_push($room_names, $room->slug);
               }
           }
       }
        
        return view('your_rooms')->with('all_rooms', $room_names);
    }
    
    
    public function send_message(Request $request) {
        
        DB::table('messages')->insert(
                ['room_id' => $request->input('room_id'),
                 'message' => $request->input('message'),
                 'author' => Auth::user()->name,
                 'created_at' => DB::raw('now()'),
                ]);
        return back();
        
    }

    public function generate_room(Request $request) {
        
        $all_slugs = DB::table('rooms')->get();
        $count = 0;
        foreach ($all_slugs as $compare_slug) {
            
            if ($request->input('slug') != $compare_slug->slug) {

                $count++;
            } 
        }
            
            if ($count == $all_slugs->count()) {
                
            DB::table('rooms')->insert(
                ['slug' => $request->input('slug'),
                 'owner' => Auth::user()->name,
                 'members' => Auth::user()->name
                ]);
            
            return redirect('your-rooms');
            } else {
                
            return redirect('url-already-exist');
            }
    }
    
    
    
    public function add_user_to_room(Request $request) {
       
        $old_room_members = DB::table('rooms')->where('id', '=', $request->input('room_id'))->pluck('members');
     
        $new_room_members = $old_room_members[0] . " " . $request->input('added_user');
        
        DB::table('rooms')->where('id', '=', $request->input('room_id'))
            ->update(['members' => $new_room_members]);
        
        return back();
    
    }
    
    
}
