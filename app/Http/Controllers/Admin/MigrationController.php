<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;
class MigrationController extends Controller
{
    
    use ResponseTraits;    
    public function __construct()
    {
        $this->routeIndex = redirect()->route('admin.management.json.index');
        $this->dirStorage = 'json';
    }

    /**
     * Index Migration Management
     * 
     * @return view
     **/
    public function index()
    {
        $migrateStatusList = explode ("\n",shell_exec('php '.base_path('artisan migrate:status')));
        $migrateStatusResult = [] ;
        foreach($migrateStatusList as $key => $migrateStatus){
            $migrateStatus = (explode('|',$migrateStatus));        
            if(@$migrateStatus[1] && $key >2)
                array_push($migrateStatusResult,[trim($migrateStatus[1]),trim($migrateStatus[2])]);
        }
        return view('admin.management.migration.index',['data'=>json_encode($migrateStatusResult)]);
    }

    /**
     * Form View Migration
     * 
     * @return view
     **/
    public function form()
    {
        return view('admin.management.migration.form');
    }

    /**
     * Get Generate Form View For Migration Purpose
     *
     * @return HTML View
     **/
    public function getGenerateForm(Request $req)
    {
        $view = view('admin.management.migration.form-generate',['length'=>$req->length])->render();
        return $this->returnResponse(200,$view);
    }

    /**
     * Get Generate Form View For Migration Purpose
     *
     * @return HTML View
     **/
    public function post(Request $req)
    {
        $tableName = strtolower($req->migration['name']);
        $command = 'php '.base_path('artisan make:migration') ." create_table_{$tableName}";
        $resultExec = shell_exec($command);
        dd($resultExec,$command);
    }
}
