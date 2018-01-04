<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;
use App\Classes\FileManager;
class JsonDummyController extends Controller
{
    
    use ResponseTraits;
    
    public function __construct()
    {
        $this->routeIndex = redirect()->route('admin.management.json.index');
        $this->dirStorage = 'json';
    }

    /**
     * Index Menu Management
     * 
     * @return view
     **/
    public function index()
    {
        return view('admin.management.json.index');
    }

    /**
     * Post Dummy JSON
     * 
     * @return view
     **/
    public function post(Request $req)
    {
        if(json_decode($req->json)){
            $fileName = generateUuid();
            $fileManager = new FileManager($fileName,$this->dirStorage);
            $fileManager->save($req->json);
            return $this->returnResponse(201,['message'=>trans('response.success.default'),'data'=>['fileName'=>$fileManager->getFileName()]]);
        }else{
            return $this->returnResponse(422,['message'=>trans('response.warning.invalid_json')]);
        }
    }

     /**
     * Get Dummy JSON
     * 
     * @return view
     **/
    public function getDummy($uuid)
    {
            $fileManager = new FileManager($uuid,$this->dirStorage);
            return response()->json(json_decode($fileManager->getFile()));
    }

}
