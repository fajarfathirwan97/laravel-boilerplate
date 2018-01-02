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
            $data = $data->where($req->search['field'],$operator,$req->search['keyword']);
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
        $data = array_merge(['uuid'=>(string)\Uuid::generate(4)],$req->menu);
        $this->menu->create($data);
        return $this->returnResponse(200,$data);
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
            return " <button id='deleteModalButton' data-toggle='modal' data-id='{$data->uuid}' class='btn btn-primary'> <span class='fa fa-trash' aria-hidden='true'></span> </button>";
        });
    }
}
