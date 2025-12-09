<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user_tbl';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'registration_date',
        'firstname',
        'middlename',
        'lastname',
        'date_of_birth',
        'contact_no',
        'email',
        'password',
        'brgy_id',          // ← foreign key to area_tbl
        'zip_code',
        'street_address',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'date_of_birth' => 'date',
        'registration_date' => 'datetime',
    ];
}
