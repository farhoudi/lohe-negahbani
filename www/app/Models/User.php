<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable {

    use Notifiable, Sortable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'personnel_id',
        'first_name',
        'last_name',
        'free_of_war',
        'married',
        'senior',
        'secretary',
        'partaker',
        'long_distance',
        'extra_description',

        //'name',
        //'email',
        //'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $sortable = [
        'personnel_id',
        'first_name',
        'last_name',
        'free_of_war',
        'married',
        'senior',
        'secretary',
        'partaker',
        'long_distance',
        'extra_description',
    ];

    public function getFullNameAttribute() {
        $fullName = '';
        if (!empty($this->first_name)) {
            $fullName = $this->first_name;
        }
        if (!empty($this->last_name)) {
            if (!empty($fullName)) {
                $fullName .= ' ' . $this->last_name;
            } else {
                $fullName = $this->last_name;
            }
        }
        return $fullName;
    }

    public function getGuardsCountAttribute() {
        return !empty($this->guards) ? $this->guards->count() : 0;
    }

    public function guards() {
        return $this->hasMany(Guard::class, 'user_id');
    }

}
