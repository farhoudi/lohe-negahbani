<?php

namespace App\Http\Controllers;

use App\Models\DistanceType;
use App\Models\Guard;
use App\Models\GuardDay;
use App\Models\GuardType;
use App\Models\User;
use App\Repositories\JdfRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /** @var JdfRepository */
    private $jdfRepository;

    /** @var DistanceType */
    private $distanceTypeRepository;

    /** @var User */
    private $userRepository;

    /** @var GuardType */
    private $guardTypeRepository;

    /** @var GuardDay */
    private $guardDayRepository;

    /** @var Guard */
    private $guardRepository;

    public function __construct(JdfRepository $jdfRepository, DistanceType $distanceTypeRepository,
                                User $userRepository, GuardType $guardTypeRepository,
                                GuardDay $guardDayRepository, Guard $guardRepository) {
        $this->jdfRepository = $jdfRepository;
        $this->distanceTypeRepository = $distanceTypeRepository;
        $this->userRepository = $userRepository;
        $this->guardTypeRepository = $guardTypeRepository;
        $this->guardDayRepository = $guardDayRepository;
        $this->guardRepository = $guardRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request) {
        $today = date('Y-m-d');
        $jToday = $this->jdfRepository->date('Y-m-d', strtotime($today));
        $guardDay = $this->guardDayRepository->where('date', $today)->first();
        $guardTypes = $this->guardTypeRepository
            ->whereIn('alias', ['slum', 'sanitarium', 'wc', 'sergeant_guardian', 'sergeant_guardian_assistant'])
            ->get();
        if (!empty($guardDay)) {
            $guards = $this->guardRepository->where('day_id', $guardDay->id)->get();
        } else {
            $guards = new Collection();
        }
        $users = $this->userRepository->with(['guards.guard_type', 'guards.day'])->get();
        $users = $users->sort(function ($a, $b) {
            if ($a->guards->count() > $b->guards->count()) {
                return true;
            } else if ($a->guards->count() < $b->guards->count()) {
                return false;
            } else {
                return $a->personnel_id > $b->personnel_id;
            }
        });


        return view('dashboard', [
            'guards' => $guards,
            'guardTypes' => $guardTypes,
            'jToday' => $jToday,
            'users' => $users,
        ]);
    }

    public function about(Request $request) {
        return view('home.about');
    }

}
