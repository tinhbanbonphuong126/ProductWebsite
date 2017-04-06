<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Undertaker extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'undertaker';

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
    protected $fillable = ['account_id', 'password','encrypt_pass', 'undertaker_name',
        'other_name', 'address', 'phone', 'emails','delflag'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token'
    ];

    public function OtRequest(){
        return $this->hasMany('App\Undertaker','undertaker_id');
    }
}
