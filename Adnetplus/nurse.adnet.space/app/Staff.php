<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'staffs';

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
        'nationality',
        'address',
        'tel',
        'email',
        'password',
        'remember_token',
        'created_by',
        'updated_by',
        'is_admin',
        'delete_flag'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    

    public function updatedBy()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }
}
