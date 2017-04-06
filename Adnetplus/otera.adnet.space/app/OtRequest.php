<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtRequest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'request';

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
    protected $fillable = [
        'funeral_id',
        'undertaker_id',
        'funeral_name',
        'chief_name',
        'start_time',
        'religious',
        'faction',
        'otera_name',
        'venue',
        'venue_address',
        'times_funeral',
        'contact_matter',
        'type_id',
        'is_new_request',
        'completed_request'
    ];

    public function funeral(){
        return $this->belongsTo('App\Funeral','funeral_id');
    }

    public function undertaker(){
        return $this->belongsTo('App\Undertaker','undertaker_id');
    }

    public function classification_request(){
        return $this->hasMany('App\ClassificationRequest','request_id');
    }

    public function request_user(){
        return $this->hasMany('App\RequestUser','request_id');
    }

    public function user_confirmed(){
        return $this->hasMany('App\UserConfirmed','request_id');
    }
}
