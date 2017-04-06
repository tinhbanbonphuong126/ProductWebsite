<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['account_id','password','encrypt_pass', 'name', 'religion',
        'birthday', 'type_id', 'address', 'phone', 'emails', 'answer', 'detail', 'mail_send','delflag'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token'
    ];

    public function user_confirmed(){
        return $this->hasMany('App\UserConfirmed','user_id');
    }

    public function type_work(){
        return $this->belongsTo('App\Type','type_id');
    }
}
