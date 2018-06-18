<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Throwable;
use Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * @var string
     */
    protected $guard = "frontend";

    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Auth::guard($this->guard)->check()) {
                return $next($request);
            } else {
                return redirect("/");
            }

        })->only(["logout"]);
    }

    /**
     * Local registration
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws Throwable
     * @throws \Throwable
     */
    function register()
    {
        if (Auth::guard($this->guard)->check()) {
            return redirect("/");
        }

        if (Request::method() == "POST") {

            $validator = Validator::make(Request::all(), [
                'first_name' => 'required|min:4',
                'last_name' => 'required|min:4',
                "email" => [
                    "required",
                    "email",
                    "unique:users,email"
                ],
                'password' => 'required|confirmed|min:6'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = new User();

            $user->username = Request::get("email");
            $user->first_name = Request::get("first_name");
            $user->last_name = Request::get("last_name");
            $user->email = Request::get("email");
            $user->provider = NULL;
            $user->password = Request::get("password");
            $user->status = 1;
            $user->backend = 0;

            $user->save();

            return redirect(route('login'))->with('status', trans('auth.account_created'));
        }

        return view("auth.register");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws Throwable
     */
    public function forget_password()
    {

        if (Auth::guard($this->guard)->check()) {
            return redirect("/");
        }

        if (Request::method() == "POST") {

            Request::validate([
                "email" => "required|email",
            ]);

            $user = User::where('email', request('email'))->whereNull('provider')->first();

            if ($user) {

                $new_pass = str_random(8);

                $user->password = $new_pass;

                $user->save();

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <info@dubarter.com>' . "\r\n";

                mail($user->email, trans('auth.new_pass_mail_subject'), view('emails.new_password', ['new_password' => $new_pass])->render(), $headers);

                return redirect('forget_password')->with('status', trans('auth.new_password_sent'));
            } else {
                return redirect('forget_password')->with('error', 'هذا الايميل غير موجود');
            }

        }

        return view("auth.forget_password");
    }

    /**
     * Auth activation
     *
     * @param null $code
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activation($code = null)
    {

        $user = User::where("code", $code)->where("code", "!=", null)->first();

        if (!$user) {
            abort(404);
        }

        $user->code = NULL;
        $user->status = 1;

        $user->save();

        Auth::guard($this->guard)->login($user);

        $this->data["user"] = $user;

        return redirect()->route('profile.edit.form')->with('status', 'تم تفعيل الحساب بنجاح');
    }

    /**
     * Local login
     *
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    function login()
    {

        if (fauth()->check()) {
            return redirect("/");
        }

        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }

        if (Request::method() == "POST") {

            $username = Request::get("email");
            $password = Request::get("password");
            $user = User::where(function ($query) use ($username) {
                $query->where('username', $username)
                    ->orWhere('email', $username);
            })->first();
            if ($user) {
                if (Hash::check($password, $user->password)) {
                    fauth()->login($user, Request::has("remember"));
                    return redirect()->intended();

                } else {
                    return redirect()->back()->withErrors('Your email or password  invalid')->withInput(Request::all());
                }
            } else {
                return redirect()->back()->withErrors(trans("Your email or password  invalid"))->withInput(Request::all());
            }
        }

        return view("auth.login");
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function logout()
    {

        fauth()->logout();

        return redirect("/");
    }
}
