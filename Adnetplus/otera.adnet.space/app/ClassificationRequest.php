<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassificationRequest extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classification_request';

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
    protected $fillable = ['request_id', 'type_id', 'count_nin', 'time_start', 'time_end'];

    public function funeral(){
        return $this->belongsTo('App\OtRequest','request_id');
    }
}
