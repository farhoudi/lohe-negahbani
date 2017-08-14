<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuardDay extends Model {

    protected $fillable = ['date', 'guards_number', 'distance_type_id', 'married'];

    public $timestamps = false;

}
