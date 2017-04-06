<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'code',
        'name',
        'gender',
        'birth_date',
        'address',
        'tel',
        'email',
        'created_by',
        'updated_by',
        'delete_flag'
    ];

    /**
     * Get the medical records for the user
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
}
