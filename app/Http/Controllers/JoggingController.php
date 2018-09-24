<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Jogging;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JoggingController extends Controller
{
 //
 public function __construct()
 {
    $this->middleware('auth:api')->only('register','getall');
 }

 public function register(Request $request)
 {
   $this->validate($request, [
     // 'user_id' => 'required|max:255',
     'jogging' => 'required|max:255',
     'start_date' => 'required|max:255',
     'end_date' => 'required|max:255',
     'comment' => 'required|max:255',
   ]);
   $user = $request -> user(); 
   $jogging = new Jogging($request->all());
   $jogging->user_id = $user->id;
   $jogging->jogging = $request->jogging;
   $jogging->start_date = $request->start_date;
   $jogging->end_date = $request->end_date;
   $jogging->comment = $request->comment;
  //  echo $jogging; exit;
   $jogging->save();
   return response()->json([
     'registered' => true,
     'api_token' => $jogging->api_token
   ]);
 }

 public function getall(Request $request)
 {
  $user =  $request -> user();
  $jogging = DB::table('joggings')->where('user_id', 1)->get();
  return $jogging;
 }

 public function delete(Request $request) {
   $data = Jogging::find( $request->id )->delete();
 }

 public function update(Request $request) {
   $data = Jogging::where('id', $request->id)->first ();
   $data->name = $request->name;
   $data->count = $request->count;
   $data->save();
   return $data;
 }
}