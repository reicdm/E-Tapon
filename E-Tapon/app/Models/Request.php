<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'REQUEST_TBL';
    protected $primaryKey = 'request_id';
    public $incrementing = false; 
    public $timestamps = false;

    protected $fillable = [
        'request_id',
        'user_id',
        'quantity',
        'waste_type',
        'preferred_date',
        'preferred_time',
        'request_date',
        'status',
        'completion_date',
        'collector_id',
        'license_plate',
    ];
}