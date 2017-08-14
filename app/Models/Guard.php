<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guard extends Model {

    protected $fillable = ['day_id', 'user_id', 'guard_type_id'];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function guard_type() {
        return $this->belongsTo(GuardType::class, 'guard_type_id');
    }

    public function day() {
        return $this->belongsTo(GuardDay::class, 'day_id');
    }

}
