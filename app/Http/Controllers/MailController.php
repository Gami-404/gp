<?php

namespace App\Http\Controllers;

use App\Mail\SendContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function send(Request $request)
    {
        Mail::to($request->get('email'))->send(new SendContactUs($request->get('email'), $request->get('message')));
        return response()->json(['status' => 'send']);
    }
}
