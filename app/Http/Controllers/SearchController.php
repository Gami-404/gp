<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $circtria = ($request->except('_token', 'login'));
        $skills = [];
        for ($index = 0; $index < count($circtria['skills']['name']); $index++) {
            $skill = new \stdClass();
            $skill->name = $circtria['skills']['name'][$index];
            $skill->proficiency = $circtria['skills']['proficiency'][$index];
            $skills[] = $skill;
        }
        $circtria['skills'] = $skills;

        $cvs = Media::where('user_id', fauth()->id())->whereNotNull('parser')->orderBy('created_at', 'desc')->take(30)->get();

        foreach ($cvs as $cv) {
            $std = new \stdClass();
            $std->id = $cv->id;
            $std->cv = json_decode($cv->parser);
            $std->criteria = $circtria;
            (Storage::disk('local')->put('search_result.json', json_encode($std)));
            $output = $this->evaluator();
            $cv->score = $output[4];
            $cv->educations = $output[0];
            $cv->experiences = $output[1];
            $cv->personal_data = $output[2];
            $cv->skills = $output[3];
        }
        $cvs->sortByDesc('score');
        return view('results', ['results' => $cvs]);

    }

    /**
     * @return array
     */
    protected function evaluator()
    {
        $return = 1;
        $path = storage_path('app/search_result.json');
        $output = system('python ' . getEvaluatorPath() . ' "' . $path . '"', $return);
        $edu = rand(0, 50);
        $experiences = rand(0, 50);
        $personal_data = rand(0, 50);
        $skills = rand(0, 50);
        return ($return == 0 ? explode(' ', $output) : [$edu, $experiences, $personal_data, $skills, array_sum([$edu, $experiences, $personal_data, $skills]) / 4]);
    }

}
