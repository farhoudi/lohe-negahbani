<?php

namespace App\Http\Controllers;

use App\Models\DistanceType;
use App\Repositories\JdfRepository;
use Illuminate\Http\Request;

class GuardianTableController extends Controller {

    /** @var JdfRepository */
    private $jdfRepository;

    /** @var DistanceType */
    private $distanceTypeRepository;

    public function __construct(JdfRepository $jdfRepository, DistanceType $distanceTypeRepository) {
        $this->jdfRepository = $jdfRepository;
        $this->distanceTypeRepository = $distanceTypeRepository;
    }

    public function weekly(Request $request) {
        $weekDiff = $request->has('week_diff') ? $request->input('week_diff') : 0;

        $today = date('Y-m-d');

        $day = (date('w', strtotime($today . ' ' . $weekDiff . ' weeks')) + 1) % 7;
        $weekStart = date('Y-m-d', strtotime($weekDiff . ' weeks' . ' -' . $day . ' days'));
        $weekEnd = date('Y-m-d', strtotime($weekDiff . ' weeks' . ' -' . (6 - $day) . ' days'));

        $jWeekStart = $this->jdfRepository->date('j F y', strtotime($weekDiff . ' weeks' . ' -' . $day . ' days'));
        $jWeekEnd = $this->jdfRepository->date('j F y', strtotime($weekDiff . ' weeks' . ' -' . (6 - $day) . ' days'));

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

        $distanceTypes = [null => 'مهم نیست'] + $this->distanceTypeRepository->whereIn('alias', ['far', 'near'])->pluck('name', 'alias')->toArray();

        return view('guard.weekly', [
            'jWeekStart' => $jWeekStart,
            'jWeekEnd' => $jWeekEnd,
            'weekDays' => $weekDays,
            'distanceTypes' => $distanceTypes,
        ]);
    }

    public function midterm(Request $request) {
        return view('guard.midterm');
    }

    public function patrol(Request $request) {
        return view('guard.patrol');
    }

    public function guardian_table(Request $request) {
        return view('guard.guardian_table');
    }

}
