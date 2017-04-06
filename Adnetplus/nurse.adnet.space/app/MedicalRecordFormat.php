<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecordFormat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medical_record_formats';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'required',
        'created_by',
        'updated_by',
        'delete_flag'
    ];
}
