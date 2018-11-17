<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;

class AdminController extends Controller
{
    use ResponseTraits;
    /**
     * Index of Admin Controller
     **/
    public function index()
    {
        return view('login.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        \Sentinel::logout();
        return view('login.login');
    }

}
