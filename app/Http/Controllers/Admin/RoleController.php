<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Menu;
use App\Models\Role;
use App\Traits\ResponseTraits;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    use ResponseTraits;

    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->routeIndex = redirect()->route('admin.management.role.index');
    }

    /**
     * Index Menu Management
     *     *
     * @return view
     **/
    public function index()
    {
        $field = $this->getFieldForSearch();
        return view('admin.management.role.index', ['field' => $field]);
    }

    /**
     * View Form Menu
     *     *
     * @return view
     **/
    public function form($uuid = null)
    {
        if ($uuid) {
            $data = $this->role->where('uuid', $uuid)->first();
            $permission = [];
            foreach ($data->permissions as $id => $value) {
                array_push($permission, ['value' => $value, 'text' => translateUrl($value)]);
            }
            $data->permission = json_encode($permission);
            if (!$data) {
                return $this->routeIndex->with(['message' => trans('response.error.internal'), 'level' => 'error']);
            }

        } else {
            $data = array_fill_keys(($this->role->getFillable()), '');
        }

        return view('admin.management.role.form', ['role' => $data]);

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
        $data = $this->role->select('name', 'slug', 'permissions', 'uuid');
        if (!isNullAndEmpty($req->search['field']) && !isNullAndEmpty($req->search['keyword'])) {
            $data = $data->where($req->search['field'], $operator, "%{$req->search['keyword']}%");
        }

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
            ['data' => 'name', 'name' => 'name'],
            ['data' => 'action', 'name' => 'href', 'orderable' => 0],
        ];
        return $this->returnResponse(200, $column);
    }
    /**
     * Datatable get Column
     *
     * @param Request $req
     * @return JSON Response
     **/
    public function post(RoleRequest $req)
    {
        $data = $req->role;
        if (!$data['uuid']) {
            $data = array_merge($req->role, ['uuid' => generateUuid(), 'permissions' => $data['permissions'], 'slug' => strtolower(str_replace(' ', '_', $data['name']))]);
            $this->role->create($data);
        } else {
            $data = array_merge($req->role, ['permissions' => json_encode($data['permissions'])]);
            $this->role->where('uuid', $data['uuid'])->update(array_except($data, ['uuid']));
        }
        return $this->routeIndex->with(['message' => trans('response.success.default'), 'level' => 'success']);
    }

    /**
     * Delete Record Menu From DB
     *
     * @param Request $req
     * @return JSON Response
     **/
    public function delete(MenuRequest $req)
    {
        $this->menu->where(['uuid' => $req->uuid])->delete();
        return $this->returnResponse(200, ['message' => trans('response.success.default')]);
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
        return $dataTable->addColumn('action', function ($data) {
            return view('layout.general-button', ['data' => $data])->render();
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
        $data = $this->role->select(
                                \DB::RAW('id'),
                                \DB::RAW('(SELECT name) as text')
                                )->where('name','like',"%{$req->search}%")
                                ->where('slug','!=','admin')->take(50)->get();
        return $this->returnResponseSelect2(200,$data);
    }    

}
