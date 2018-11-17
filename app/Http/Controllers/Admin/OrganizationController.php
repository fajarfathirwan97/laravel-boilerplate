<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use App\Models\User;
use App\Traits\ResponseTraits;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    use ResponseTraits;

    public function __construct(Organization $model)
    {
        $this->model = $model;
        $this->viewPath = 'admin.management.organization';
        $this->routeIndex = redirect()->route("{$this->viewPath}.index");
    }

    /**
     * Index Organization Management
     *
     * @return view
     **/
    public function index()
    {
        $field = $this->getFieldForSearch();
        return view("{$this->viewPath}.index", ['field' => $field]);
    }

    /**
     * View Form Menu
     *     *
     * @return view
     **/
    public function form($uuid = null)
    {
        if ($uuid) {
            $data = $this->model->where('uuid', $uuid)->first();
            if (!$data) {
                return $this->routeIndex->with(['message' => trans('response.error.internal'), 'level' => 'error']);
            }

        } else {
            $data = array_fill_keys(($this->model->getFillable()), '');
        }

        return view("{$this->viewPath}.form", ['data' => $data, 'tableName' => $this->model->getTable()]);

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
        $data = $this->model->select(
            'uuid',
            'id',
            'name',
            'logo',
            'email',
            'phone',
            'website'
        );
        if (!isNullAndEmpty($req->search['field']) && !isNullAndEmpty($req->search['keyword'])) {
            $data = $data->where($req->search['field'], $operator, "%{$req->search['keyword']}%");
        }

        $dataTable = datatables($data);
        $dataTable = $this->addActionColumn($dataTable);
        $dataTable = $this->modifyImageAttribute($dataTable);
        return $dataTable->rawColumns(['logo', 'action'])->make(true);
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
            ['data' => 'logo', 'name' => 'logo'],
            ['data' => 'email', 'name' => 'email'],
            ['data' => 'website', 'name' => 'website'],
            ['data' => 'phone', 'name' => 'phone'],
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
    public function post(OrganizationRequest $req)
    {
        $data = $req->{$this->model->getTable()};
        if ($data['logo']) {
            $data['logo'] = saveImageFromBase64($data['logo']);
        } else {
            unset($data['logo']);
        }
        if (!$data['uuid']) {
            $data = array_merge($data, ['uuid' => (string) \Uuid::generate(4)]);
            $this->model->create($data);
        } else {
            $query = $this->model->where('uuid', $data['uuid']);
            if (@$data['logo']) {
                deleteImageFromStorage(storage_path('app/public/' . str_replace(request()->getHttpHost() . '/storage/', '', $query->first()->logo)));
            }
            $query->update(array_except($data, ['uuid']));
        }
        return $this->routeIndex->with(['message' => trans('response.success.default'), 'level' => 'success']);
    }

    /**
     * Delete Record Menu From DB
     *
     * @param Request $req
     * @return JSON Response
     **/
    public function delete(OrganizationRequest $req)
    {
        $this->model->where(['uuid' => $req->uuid])->delete();
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
            'name' => trans('form.organizations.name'),
            'email' => trans('form.organizations.email'),
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
            return view('layout.general-button', ['showOnly' => @\Sentinel::check()->userOrganization()->first()->organization_id == @$data->id, 'viewPath' => $this->viewPath, 'data' => $data, 'url' => route("{$this->viewPath}.detail", $data->uuid)])->render();
        });
    }

    /**
     * Modify Image attribute
     *
     * @param Datatable $dataTable
     * @return Datatable $dataTable
     **/
    public function modifyImageAttribute($dataTable)
    {
        return $dataTable->editColumn('logo', function ($data) {
            return view('layout.image', ['url' => 'http://' . $data->logo])->render();
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
        $data = $this->model->select(
            \DB::RAW('id'),
            \DB::RAW('(SELECT name) as text')
        )->where('name', 'like', "%{$req->search}%")->take(50)->get();
        return $this->returnResponseSelect2(200, $data);
    }

    /**
     * Detail Organization
     *
     * @param Request $req
     * @return json
     **/
    public function detail($uuid)
    {
        $data = $this->model->whereUuid($uuid)->first();
        $user = new User();
        $userController = new UserController($user);
        return view("$this->viewPath.detail", ['data' => $data, 'field' => $userController->getFieldForSearch()]);
    }
}
