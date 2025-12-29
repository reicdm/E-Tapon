<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area_tbl';
    protected $primaryKey = 'brgy_id';
    public $timestamps = false;

    protected $fillable = ['brgy_name'];
}