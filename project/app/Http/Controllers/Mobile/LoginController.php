<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Cookie;
use Redirect;
use App\Post;
use App\Reader;

class LoginController extends Controller
{
	public $data = array();
	
    public function login(Request $request)
    {
		$params = $request->all();
		
		$readerModel = new Reader;
		
		if (isset($params['user_login']) && isset($params['user_password']))
		{
			if (filter_var($params['user_login'], FILTER_VALIDATE_EMAIL)) {
				$type = 1;
			}
			else
			{
				$type = 2;
			}

			$dbParams = array();
			$dbParams['user_login'] = $params['user_login'];
			$dbParams['user_password'] = sha1(env('AUTH_KEY').':'.$params['user_password']);
			
			$loginProfile = $readerModel->login($dbParams, $type);
			
			if (count($loginProfile) > 0)
			{
				Session::put('reader_id', $loginProfile[0]->reader_id);
				Session::put('reader_image', $loginProfile[0]->reader_image);
				Session::put('email', $loginProfile[0]->email);
				Cookie::queue('reader_id', $loginProfile[0]->reader_id, 365*24*60);
				Cookie::queue('reader_image', $loginProfile[0]->reader_image, 365*24*60);
				Cookie::queue('email', $loginProfile[0]->email, 365*24*60);
				
				return Redirect::route('m_topPage');
			}
			
		}
		
        return view('mobile.login', $this->data);
    }
	
	public function register(Request $request)
    {
		
		if ($request->isMethod('post')) {
			
			$params = $request->all();
			
			if (isset($params['user_login']) && isset($params['user_password']) && isset($params['display_name']))
			{
				$dbParams = array();
				
				if (filter_var($params['user_login'], FILTER_VALIDATE_EMAIL)) {
					$dbParams['email'] = $params['user_login'];
				}
				else
				{
					$dbParams['tel_no'] = $params['user_login'];
				}
				
				$dbParams['password'] = sha1(env('AUTH_KEY').':'.$params['user_password']);
				$dbParams['display_name'] = $params['display_name'];
				$dbParams['create_date'] = date("Y-m-d H:i:s");
				
				$readerModel = new Reader;
				
				$reader_id = $readerModel->registReader($dbParams);
				
				if ($reader_id > 0)
				{
					return Redirect::route('m_register_complete');
				}
			}
			
		}
		
		return view('mobile.register', $this->data);
		
	}
	
	public function registerComplete(Request $request)
    {
		
		return view('mobile.register_complete', $this->data);
		
	}
}