<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository {

    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function usersWithGuards() {
        return $this->user->with(['guards.guard_type', 'guards.guard_day'])->get();
    }

}