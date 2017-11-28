<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TranquiloUsers extends Authenticatable
{
    use Notifiable;

    public $table = 'tranquilo_users';

    protected $fillable = ['name','phone_no','email','role','address','state','status','img','password','remember_token','created_at'];
}
