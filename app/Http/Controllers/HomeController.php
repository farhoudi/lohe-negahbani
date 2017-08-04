<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request) {


        return view('dashboard', [
        ]);
    }

    public function home(Request $request) {
        $featuredCourses = $this->courseRepository->orderBy('created_at', 'desc')->limit(4)->where(['featured' => true])->all();
        $bestCourses = $this->courseRepository->orderBy('created_at', 'desc')->limit(4)->where(['best' => true])->all();
        $mostVisitedCourses = $this->courseRepository->orderBy('created_at', 'desc')->limit(4)->where(['most_visited' => true])->all();
        $newestCourses = $this->courseRepository->orderBy('created_at', 'desc')->limit(4)->all();
        $parentCategories = $this->categoryRepository->whereNull('parent_id')->all();
        foreach ($parentCategories as $category) {
            if (!empty($category->icon160x160)) {
                $category->setAttribute('icon', str_replace(basename($category->icon), '160x160_' . basename($category->icon), $category->getOriginal('icon')));
            }
        }

        foreach ($featuredCourses as $course) {
            if (!empty($course->cover)) {
                $course->cover = str_replace(basename($course->cover), '400x200_' . basename($course->cover), $course->getOriginal('cover'));
            }
        }
        foreach ($bestCourses as $course) {
            if (!empty($course->cover)) {
                $course->cover = str_replace(basename($course->cover), '400x200_' . basename($course->cover), $course->getOriginal('cover'));
            }
        }
        foreach ($mostVisitedCourses as $course) {
            if (!empty($course->cover)) {
                $course->cover = str_replace(basename($course->cover), '400x200_' . basename($course->cover), $course->getOriginal('cover'));
            }
        }
        foreach ($newestCourses as $course) {
            if (!empty($course->cover)) {
                $course->cover = str_replace(basename($course->cover), '400x200_' . basename($course->cover), $course->getOriginal('cover'));
            }
        }

        return view('home', [
            'featuredCourses' => $featuredCourses,
            'bestCourses' => $bestCourses,
            'mostVisitedCourses' => $mostVisitedCourses,
            'newestCourses' => $newestCourses,
            'parentCategories' => $parentCategories,
        ]);
    }

    public function about(Request $request) {
        return view('home.about');
    }

    public function contact(Request $request) {
        return view('home.contact');
    }

    public function do_contact(Request $request) {
        $this->validate($request, Feedback::$rules + ['g-recaptcha-response' => 'required|recaptcha']);
        $input = $request->all();

        $feedbackData = [
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'message' => $input['message'],
        ];
        if (!empty($request->user())) {
            $feedbackData['user_id'] = $request->user()->id;
        }
        $this->feedbackRepository->create($feedbackData);

        event(new FeedbackSent());

        Flash::success('پیام شما با موفقیت ارسال شد.');
        return redirect()->back();
    }

    public function terms(Request $request) {
        return view('home.terms');
    }

    public function search(Request $request) {
        return view('home.search');
    }

    public function course(Request $request) {
        return view('home.course');
    }

}
