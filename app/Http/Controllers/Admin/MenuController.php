<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;
use App\Classes\HTMLGenerator;
use App\Models\User;
use App\Http\Requests\UserRequest;

class MenuController extends Controller
{
    
    use ResponseTraits;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Index Menu Management
     *     *
     * @return view
     **/
    public function index()
    {
        return view('admin.management.menu.index');
    }

    /**
     * Datatable json generator
     * 
     * @param Request $req
     * @return Datatables
     **/
    public function datatable(Request $req)
    {
        $user = $this->user->select(
            \DB::RAW('CONCAT(first_name,\' \',last_name) as full_name')
        );
        return datatables($user)->make(true);
    }

    /**
     * Datatable get Column
     * 
     * @param Request $req
     * @return JSON Response
     **/
    public function getDatatableColumn(Request $req)
    {
        $column = [
            ['data'=>'full_name','name'=>'full_name'],
            ['data'=>'full_name','name'=>'full_name'],
            ['data'=>'full_name','name'=>'full_name'],
            ['data'=>'full_name','name'=>'full_name'],
        ];
        return $this->returnResponse(200,$column);
    }
}
