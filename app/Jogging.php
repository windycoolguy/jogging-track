<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogging extends Model
{
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'user_id', 'name', 'count'
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       'password', 'remember_token', 'api_token'
   ];
}