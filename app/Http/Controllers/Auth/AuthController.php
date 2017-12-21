<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;
use App\Traits\ResponseTraits;
class AuthController extends Controller
{
	use ResponseTraits;

	/**
	 * Controller For Authentication
	 * @param Request $req
	 * @return view
	 * @author Fajar
	 **/
	public function auth(Request $req)
	{
		try{
			$auth = Sentinel::authenticate($req->auth);	
			if($auth)
				return response()->redirectToRoute('admin.dashboard');
			else
				return redirect()->back()->with(['message'=>'response.warning.login','level'=>'warning']);
		}catch(\Exception $e){
				\Log::error(['Message'=>$e->getMessage(),'File'=>$e->getFile(),'Line'=>$e->getLine()]);
				return $this->returnResponse(500,['message'=>trans('response.error.internal'),'data'=>[]]);		
		}
	}

}
