<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;
use App\Classes\HTMLGenerator;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    use ResponseTraits;
    /**
     * View Form User
     **/
    public function form($id)
    {
        $user = new User;
        $userData = $user->whereId($id)->first()->toArray();
        return view('admin.user.form',['user' => $userData]);
    }
    /**
     * View Form User
     **/
    public function post(UserRequest $req)
    {
        $user = new User;
        $userData = $user->whereId($req->id)->update($req->except(['current_password','_token']));
        return view('admin.user.form',['user' => $userData]);
    }


}
