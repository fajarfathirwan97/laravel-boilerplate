<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTraits;
use App\Classes\HTMLGenerator;
use App\Models\Menu;
use App\Http\Requests\MenuRequest;

class MenuController extends Controller
{
    
    use ResponseTraits;
    
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
        $this->routeIndex = redirect()->route('admin.management.menu.index');
    }

    /**
     * Index Menu Management
     *     *
     * @return view
     **/
    public function index()
    {
        $field = $this->getFieldForSearch();
        return view('admin.management.menu.index',['field'=>$field]);
    }

    /**
     * View Form Menu
     *     *
     * @return view
     **/
    public function form($uuid = null)
    {
        if($uuid){
            $data = $this->menu->where('uuid',$uuid)->first();
            if(!$data)
                return $this->routeIndex->with(['message'=>trans('response.error.internal'),'level'=>'error']);
        }
        else
            $data = array_fill_keys(($this->menu->getFillable()),'');

        return view('admin.management.menu.form',['menu'=>$data]);
            
    }
    /**
     * Datatable json generator
     * 
     * @param Request $req
     * @return Datatables
     **/
    public function datatable(Request $req)
    {
        $operator = $req->search['operator'] == 'equal' ? 'like' : 'not like';
        $data = $this->menu->select(
            'uuid',
            'name',
            'href'
        );
        if(!isNullAndEmpty($req->search['field']) && !isNullAndEmpty($req->search['keyword']))
            $data = $data->where($req->search['field'],$operator,"%{$req->search['keyword']}%");
        $dataTable = datatables($data);
        $dataTable = $this->addActionColumn($dataTable);
        return $dataTable->make(true);
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
            ['data'=>'name','name'=>'name'],
            ['data'=>'href','name'=>'href'],
            ['data'=>'action','name'=>'href','orderable'=>0],
        ];
        return $this->returnResponse(200,$column);
    }
     /**
     * Datatable get Column
     * 
     * @param Request $req
     * @return JSON Response
     **/
    public function post(MenuRequest $req)
    {
        $data = $req->menu;
        if(!$data['uuid']){
            $data = array_merge($req->menu,['uuid'=>(string)\Uuid::generate(4)]);
            $this->menu->create($data);
        }else{
            $this->menu->where('uuid',$data['uuid'])->update(array_except($data,['uuid']));
        }
        return $this->routeIndex->with(['message'=>trans('response.success.default'),'level'=>'success']);
    }

    /**
     * Delete Record Menu From DB
     * 
     * @param Request $req
     * @return JSON Response
     **/
    public function delete(MenuRequest $req)
    {
        $this->menu->where(['uuid'=>$req->uuid])->delete();
        return $this->returnResponse(200,['message'=>trans('response.success.default')]);
    }
    /**
     * Get Field
     * 
     * @param Request $req
     * @return JSON Response
     **/
    public function getFieldForSearch()
    {
        $field = [
            'name' => trans('form.menu.name'),
            'href' => trans('form.menu.href')
        ];
        return transformToOptionHTML($field);
    }

    /**
     * Add Column Action
     * 
     * @param Datatable $dataTable
     * @return Datatable $dataTable
     **/
    public function addActionColumn($dataTable)
    {
        return $dataTable->addColumn('action',function($data){
            return view('layout.general-button',['data'=>$data])->render();
        });
    }

    /**
     * Select2 Dropdown
     *
     * @param Request $req
     * @return json
     **/
    public function select2(Request $req)
    {
        $data = $this->menu->select(
                                \DB::RAW('id'),
                                \DB::RAW('(SELECT name) as text')
                                )->where('name','like',"%{$req->search}%")->where('is_parent',$req->isParent)->get();
        return $this->returnResponseSelect2(200,$data);
    }
}
