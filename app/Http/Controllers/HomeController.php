<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('upload');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
            ]);
            $user=fauth()->user();
            $user->first_name=$request->get('first_name');
            $user->last_name=$request->get('last_name');
            $user->email=$request->get('email');
            $user->save();
        }
        return view('edit-profile');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }
}
