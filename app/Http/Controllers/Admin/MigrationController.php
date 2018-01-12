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
        $this->htmlRender = new HTMLRenderer();
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
}
