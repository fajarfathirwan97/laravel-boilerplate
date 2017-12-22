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
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
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
    public function post(UserRequest $req,User $user)
    {
        $data = array_except($req->all(),['user.current_password','_token']);
        $data = array_merge($data['user'],['password' => \Hash::make($data['user']['password'])]);
        if($req->user['id'])
            $userData = $user->whereId($req->user['id'])->update($data);
        return redirect()->back()->with(['message'=>trans('response.success.change_password'),'level'=>'success']);
    }


}
