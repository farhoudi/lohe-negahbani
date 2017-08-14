<?php

namespace App\Http\Controllers;

use App\Models\DistanceType;
use App\Models\Guard;
use App\Models\GuardDay;
use App\Models\GuardType;
use App\Models\User;
use App\Repositories\JdfRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuardianTableController extends Controller {

    /** @var JdfRepository */
    private $jdfRepository;

    /** @var DistanceType */
    private $distanceTypeRepository;

    /** @var GuardDay */
    private $guardDayRepository;

    /** @var Guard */
    private $guardRepository;

    /** @var GuardType */
    private $guardTypeRepository;

    /** @var User */
    private $userRepository;

    public function __construct(JdfRepository $jdfRepository, DistanceType $distanceTypeRepository,
                                GuardDay $guardDayRepository, Guard $guardRepository,
                                GuardType $guardTypeRepository, User $userRepository) {
        $this->jdfRepository = $jdfRepository;
        $this->distanceTypeRepository = $distanceTypeRepository;
        $this->guardDayRepository = $guardDayRepository;
        $this->guardRepository = $guardRepository;
        $this->guardTypeRepository = $guardTypeRepository;
        $this->userRepository = $userRepository;
    }

    public function weekly(Request $request) {
        $weekDiff = $request->has('week_diff') ? $request->input('week_diff') : 0;

        $today = date('Y-m-d');

        $day = (date('w', strtotime($today . ' ' . $weekDiff . ' weeks')) + 1) % 7;
        $weekStart = date('Y-m-d', strtotime($weekDiff . ' weeks' . ' -' . $day . ' days'));
        //$weekEnd = date('Y-m-d', strtotime($weekDiff . ' weeks' . ' -' . (6 - $day) . ' days'));

        $jWeekStart = $this->jdfRepository->date('j F y', strtotime($weekDiff . ' weeks' . ' -' . $day . ' days'));
        //$jWeekEnd = $this->jdfRepository->date('j F y', strtotime($weekDiff . ' weeks' . ' -' . (6 - $day) . ' days'));

        $weekDays = [];
        for ($i = 0; $i <= 6; $i++) {
            $d = date('Y-m-d', strtotime($weekStart . ' +' . $i . ' days'));

            $guardDay = $this->guardDayRepository->where('date', $d)->first();

            $wd = [
                //'enabled' => true,
                'date' => $d,
                'jDate' => $this->jdfRepository->date('j F y', strtotime($d)),
                'jWeekdayName' => $this->jdfRepository->date('l', strtotime($d)),
                'day_id' => !empty($guardDay) ? $guardDay->id : 0,
            ];
            /*if ($d < $today) {
                $wd['enabled'] = false;
            }*/
            $weekDays[] = $wd;
        }
        $jWeekEnd = $this->jdfRepository->date('j F y', strtotime($weekDays[6]['date']));
//        dd($weekDays);

        $guardDays = $this->guardDayRepository->whereIn('date', array_column($weekDays, 'date'))->orderBy('date')->get();
        $guards = $this->guardRepository->with(['user.guards', 'day', 'guard_type'])->whereIn('day_id', $guardDays->pluck('id')->toArray())->get();

        $guardTypes = $this->guardTypeRepository
            ->whereIn('alias', ['slum', 'sanitarium', 'wc', 'sergeant_guardian', 'sergeant_guardian_assistant'])
            ->get();


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

        return view('guardian_table.weekly', [
            'jWeekStart' => $jWeekStart,
            'jWeekEnd' => $jWeekEnd,
            'weekDays' => $weekDays,
            'guards' => $guards,
            'guardTypes' => $guardTypes,
            'users' => $users,
        ]);
    }

    public function midterm(Request $request) {
        return view('guard.midterm');
    }

    public function patrol(Request $request) {
        return view('guard.patrol');
    }

    public function change_guard(Request $request) {
        if ($request->has('guard_id') && $request->has('new_user_id')) {
            $guard = $this->guardRepository->where('id', $request->input('guard_id'))->first();
            if (!empty($guard)) {
                $guard->user_id = $request->input('new_user_id');
                $guard->save();
                session()->flash('success', 'با موفقیت تعویض شد.');
                return redirect()->back();
            }
        }
        session()->flash('warning', 'خطا در تعویض پست!');
        return redirect()->back();
    }

}
