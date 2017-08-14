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

class GuardController extends Controller {

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
            $wd = [
                'enabled' => true,
                'date' => $d,
                'jDate' => $this->jdfRepository->date('j F y', strtotime($d)),
            ];
            if ($d < $today) {
                $wd['enabled'] = false;
            }
            $weekDays[] = $wd;
        }
        $jWeekEnd = $this->jdfRepository->date('j F y', strtotime($weekDays[6]['date']));

        $distanceTypes = [null => 'مهم نیست'] + $this->distanceTypeRepository->whereIn('alias', ['far', 'near'])->pluck('name', 'alias')->toArray();

        $guardTypes = $this->guardTypeRepository
            ->whereIn('alias', ['slum', 'sanitarium', 'wc', 'sergeant_guardian', 'sergeant_guardian_assistant'])
            ->get();

        if ($request->has('set_guard') && $request->input('set_guard') == 'true') {
            if ($request->has('weekday')) {
                foreach ($request->input('weekday') as $weekdayNumber => $date) {
                    $dayBeforeYesterday = date('Y-m-d', strtotime($date . ' -2 day'));
                    $yesterday = date('Y-m-d', strtotime($date . ' -1 day'));
                    $tomorrow = date('Y-m-d', strtotime($date . ' +1 day'));
                    $dayAfterTomorrow = date('Y-m-d', strtotime($date . ' +2 day'));
                    $isMarriedAllowed = $request->has('married_guard.' . $weekdayNumber);
                    $distanceType = $this->distanceTypeRepository
                        ->where('alias', $request->input('guard_distance.' . $weekdayNumber))
                        ->first();
                    $guardDay = $this->guardDayRepository->where('date', $date)->first();
                    if (!empty($guardDay)) {
                        $this->guardRepository->where('day_id', $guardDay->id)->delete();
                        $guardDay->update([
                            //'date' => $date,
                            'guards_number' => 0,
                            'distance_type_id' => !empty($distanceType) ? $distanceType->id : null,
                            'married' => $isMarriedAllowed,
                        ]);
                    } else {
                        $guardDay = $this->guardDayRepository->create([
                            'date' => $date,
                            'guards_number' => 0,
                            'distance_type_id' => !empty($distanceType) ? $distanceType->id : null,
                            'married' => $isMarriedAllowed,
                        ]);
                    }

                    foreach ($request->input('guards_number.' . $weekdayNumber) as $guardTypeId => $guardsNumber) {

                        $guardType = $guardTypes->where('id', $guardTypeId)->first();

                        for ($i = 0; $i < $guardType->guards_number; $i++) {

                            $users = $this->userRepository->with(['guards.guard_type', 'guards.day'])->get();
                            /*$users = $users->sort(function ($a, $b) {
                                return $a->guards->count() > $b->guards->count();
                            });*/
                            $minGuardsCount = $users->min(function ($item) {
                                return $item->guards->count();
                            });
                            $users = $users->filter(function ($item) use ($minGuardsCount) {
                                return $item->guards->count() == $minGuardsCount;
                            });

                            if (!$guardType->free_of_war) {
                                $users = $users->filter(function ($item) {
                                    return !$item->free_of_war;
                                });
                            }

                            if ($request->has('guard_distance.' . $weekdayNumber)) {
                                $distance = $request->input('guard_distance.' . $weekdayNumber);
                                $users = $users->filter(function ($item) use ($distance) {
                                    return ($distance == 'far') == $item->long_distance;
                                });
                            }

                            if ($request->has('between_days')) {
                                $betweenDays = $request->input('between_days');
                                if (in_array($betweenDays, [1, 2])) {
                                    $exceptDays = [];
                                    if ($betweenDays == 1) {
                                        $exceptDays = [$yesterday, $date, $tomorrow];
                                    } else if ($betweenDays == 2) {
                                        $exceptDays = [$dayBeforeYesterday, $yesterday, $date, $tomorrow, $dayAfterTomorrow];
                                    }

                                    $guardDays = $this->guardDayRepository->whereIn('date', $exceptDays)->get();
                                    if ($guardDays->count() > 0) {
                                        $guardDayIds = $guardDays->pluck('id')->toArray();
                                        if (!empty($guardDayIds)) {
                                            $users = $users->filter(function ($item) use ($guardDayIds) {
                                                return $item->guards->whereIn('day_id', $guardDayIds)->count() <= 0;
                                            });
                                        }
                                    }

                                }
                            }

                            $users = $users->sortBy('id');

                            if ($guardType->free_of_war && $users->where('free_of_war', true)->count() > 0) {
                                $users = $users->filter(function ($item) {
                                    return $item->free_of_war;
                                });
                            }

                            if ($isMarriedAllowed && $users->where('married', true)->count() > 0) {
                                $users = $users->filter(function ($item) {
                                    return $item->married;
                                });
                            }

                            if (!$request->has('guard_distance.' . $weekdayNumber) && $users->where('long_distance', false)->count() > 0) {
                                $users = $users->filter(function ($item) {
                                    return !$item->long_distance;
                                });
                            }

                            if ($users->count() > 0) {
                                $user = $users->first();
                                $this->guardRepository->create([
                                    'day_id' => $guardDay->id,
                                    'user_id' => $user->id,
                                    'guard_type_id' => $guardType->id,
                                ]);
                            }
                        }
                    }
                }
            }
            session()->flash('success', 'با موفقیت ثبت شد.');
            return redirect()->route('guardian_table.weekly', ['week_diff' => $weekDiff]);
        }

        return view('guard.weekly', [
            'jWeekStart' => $jWeekStart,
            'jWeekEnd' => $jWeekEnd,
            'weekDays' => $weekDays,
            'distanceTypes' => $distanceTypes,
            'guardTypes' => $guardTypes,
        ]);
    }

    public function midterm(Request $request) {
        return view('guard.midterm');
    }

    public function patrol(Request $request) {
        return view('guard.patrol');
    }

}
