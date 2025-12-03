<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CollectorAuth extends Authenticatable
{
    protected $guard = 'collector';
    protected $table = 'collector_tbl';
    protected $primaryKey = 'collector_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'collector_id',
        'email',
        'password',
        'firstname',
        'middlename',
        'lastname',
        'contact_no',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
