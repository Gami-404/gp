<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (fauth()->check()) {
                return $next($request);
            } else {
                return redirect("/login");
            }

        });
    }

    /**
     * @route search.form
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchForm(Request $request)
    {
        return view('search');
    }

    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        $inputs = ($request->except('_token', 'login'));
        $skills = [];
        for ($index = 0; $index < count($inputs['skills']['name']); $index++) {
            $skill = new \stdClass();
            $skill->name = $inputs['skills']['name'][$index];
            $skill->proficiency = $inputs['skills']['proficiency'][$index];
            $skills[] = $skill;
        }
        $inputs['skills'] = $skills;
        $std=new \stdClass();
//        $std->id
//        ((json_encode($inputs)));
    }
}
