<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funeral extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'funeral';

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
    protected $fillable = ['funeral_name'];

    public function otrequest(){
        return $this->hasMany('App\OtRequest','funeral_id','id');
    }
}
