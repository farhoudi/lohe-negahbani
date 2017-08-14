<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Flash;

class UserController extends Controller {

    /** @var User $userRepository */
    private $userRepository;

    public function __construct(User $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = $this->userRepository->with('guards')->sortable()->paginate(200);
        if (\request()->has('sort') && \request()->input('sort') == 'guards_count') {
            if (\request()->has('order') && \request()->input('order') == 'desc') {
                $users = $users->sort(function ($a, $b) {
                    if ($a->guards->count() < $b->guards->count()) {
                        return true;
                    } else if ($a->guards->count() > $b->guards->count()) {
                        return false;
                    } else {
                        return $a->personnel_id > $b->personnel_id;
                    }
                });
            } else {
                $users = $users->sort(function ($a, $b) {
                    if ($a->guards->count() > $b->guards->count()) {
                        return true;
                    } else if ($a->guards->count() < $b->guards->count()) {
                        return false;
                    } else {
                        return $a->personnel_id > $b->personnel_id;
                    }
                });
            }
        }

        return view('users.index', [
            'users' => $users,
            'i' => 1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'personnel_id' => 'required|numeric|unique:users,personnel_id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'extra_description' => 'nullable|string',
        ]);

        $userData = [
            'personnel_id' => (int)$request->input('personnel_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'extra_description' => $request->input('extra_description'),
        ];
        if ($request->has('free_of_war')) {
            $userData['free_of_war'] = true;
        }
        if ($request->has('married')) {
            $userData['married'] = true;
        }
        if ($request->has('senior')) {
            $userData['senior'] = true;
        }
        if ($request->has('secretary')) {
            $userData['secretary'] = true;
        }
        if ($request->has('partaker')) {
            $userData['partaker'] = true;
        }
        if ($request->has('long_distance')) {
            $userData['long_distance'] = true;
        }

        $this->userRepository->create($userData);
        session()->flash('success', 'اطلاعات نفر با موفقیت ثبت شد.');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        $this->validate($request, [
            'personnel_id' => 'required|numeric|unique:users,personnel_id,' . $user->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'extra_description' => 'nullable|string',
        ]);

        $user->personnel_id = (int)$request->input('personnel_id');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->free_of_war = $request->has('free_of_war');
        $user->married = $request->has('married');
        $user->senior = $request->has('senior');
        $user->secretary = $request->has('secretary');
        $user->partaker = $request->has('partaker');
        $user->long_distance = $request->has('long_distance');
        $user->extra_description = $request->has('extra_description') ? $request->input('extra_description') : null;
        $user->save();

        session()->flash('success', 'اطلاعات نفر با موفقیت بروز شد.');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->delete();

        session()->flash('success', 'اطلاعات نفر با موفقیت حذف شد.');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) {

        $users = new Collection();
        if ($request->has('action') && $request->input('action') == 'read_file') {
            $filePath = '';
            try {
                if ($request->hasFile('file')) {
                    $fileName = $request->file('file')->storeAs('excel', time());
                    $filePath = storage_path('app' . DIRECTORY_SEPARATOR . $fileName);
                    Excel::load($filePath, function($reader) use ($users) {
                        $rows = $reader->limitColumns(10)->first();
                        foreach ($rows as $row) {
                            $row = array_values($row->toArray());
                            $users->add(new User([
                                'personnel_id' => !empty($row[0]) ? (int)$row[0] : null,
                                'first_name' => !empty($row[1]) ? $row[1] : null,
                                'last_name' => !empty($row[2]) ? $row[2] : null,
                                'free_of_war' => !empty($row[3]),
                                'married' => !empty($row[4]),
                                'senior' => !empty($row[5]),
                                'secretary' => !empty($row[6]),
                                'partaker' => !empty($row[7]),
                                'long_distance' => !empty($row[8]),
                                'extra_description' => !empty($row[9]) ? $row[9] : null,
                            ]));
                        }
                    });
                    //$file = new File($filePath);
                    //dd($file->getBasename());

                    $users = $users->sortBy('personnel_id');
                }
            } catch (\Exception $exception) {

            } finally {
                if (!empty($filePath) && file_exists($filePath)) {
                    unlink($filePath);
//                dd($filePath);
                    //Storage::delete($filePath);
                }
            }

//            dd($users->toArray());
        } else if ($request->has('action') && $request->input('action') == 'import') {
            if ($request->has('user') && is_array($request->input('user'))) {
                foreach ($request->input('user') as $user) {
                    $this->userRepository->create([
                        'personnel_id' => !empty($user['personnel_id']) ? (int)$user['personnel_id'] : null,
                        'first_name' => !empty($user['first_name']) ? $user['first_name'] : null,
                        'last_name' => !empty($user['last_name']) ? $user['last_name'] : null,
                        'free_of_war' => !empty($user['free_of_war']),
                        'married' => !empty($user['married']),
                        'senior' => !empty($user['senior']),
                        'secretary' => !empty($user['secretary']),
                        'partaker' => !empty($user['partaker']),
                        'long_distance' => !empty($user['long_distance']),
                        'extra_description' => !empty($user['extra_description']) ? $user['extra_description'] : null,
                    ]);
                }
                session()->flash('success', 'اطلاعات افراد با موفقیت به نرم افزار وارد شدند!');
                return redirect()->route('users.index');
            }
        }

        return view('users.import', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function do_import(Request $request) {
    }

}
