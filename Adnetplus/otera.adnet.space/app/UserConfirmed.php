<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConfirmed extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_confirmed';

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
    protected $fillable = ['user_id','request_id', 'type_id', 'type_confirm','reason_id','content','delflag'];

    public function requests(){
        return $this->belongsTo('App\OtRequest','request_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function reason(){
        return $this->belongsTo('App\Reason','reason_id');
    }
}
