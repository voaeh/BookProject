<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use Session;
use Cookie;
use Redirect;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{

    public function action(Request $request)
    {
		$cookie = Cookie::forget('reader_id');
		Session::forget('reader_id');
		Session::forget('reader_image');
		Session::forget('email');

		return Redirect::route('m_topPage')->withCookie($cookie);
    }
}
