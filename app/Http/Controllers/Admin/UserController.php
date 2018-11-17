<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagementRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\ResponseTraits;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ResponseTraits;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->model = $user;
        $this->viewPath = 'admin.management.user';
        $this->routeIndex = redirect()->route("{$this->viewPath}.index");
    }

    /**
     * Index Menu Management
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
    public function formManagement($uuid = null)
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
     * View Form User
     **/
    public function form($id)
    {
        $user = new User;
        $userData = $user->whereId($id)->first()->toArray();
        return view('admin.user.form', ['user' => $userData]);
    }

    /**
     * View Form User
     **/
    public function post(UserRequest $req, User $user)
    {
        $data = array_except($req->all(), ['user.current_password', '_token']);
        $data = array_merge($data['user'], ['password' => \Hash::make($data['user']['password'])]);
        if ($req->user['id']) {
            $userData = $user->whereId($req->user['id'])->update($data);
        }

        return redirect()->back()->with(['message' => trans('response.success.change_password'), 'level' => 'success']);
    }

    /**
     * View Form User
     **/
    public function postManagement(UserManagementRequest $req, User $user)
    {
        $data = $req->{$this->model->getTable()};
        if ($data['avatar']) {
            $data['avatar'] = saveImageFromBase64($data['avatar']);
        } else {
            unset($data['avatar']);
        }
        if (!$data['uuid']) {
            $data = array_merge($data, ['username' => $data['email'], 'uuid' => (string) \Uuid::generate(4)]);
            \DB::beginTransaction();
            try {
                $role = new Role;
                $role = $role->whereId($data['role'])->first();
                $user = \Sentinel::registerAndActivate($data);
                $role->users()->attach($user->id);
                \DB::commit();
            } catch (\Exception $e) {
                dd($e->getMessage(), $e->getFile(), $e->getLine());
                \DB::rollback();
            }
        } else {
            $query = $this->model->where('uuid', $data['uuid']);
            unset($data['role'],$data['organization']);
            if (@$data['avatar']) {
                deleteImageFromStorage(storage_path('app/public/' . str_replace(request()->getHttpHost() . '/storage/', '', $query->first()->avatar)));
            }
            $query->update(array_except($data, ['uuid']));
        }
        return $this->routeIndex->with(['message' => trans('response.success.default'), 'level' => 'success']);
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
            "fullname" => trans('form.user.fullname'),
            'email' => trans('form.user.email'),
        ];
        return transformToOptionHTML($field);
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
            ['data' => 'fullname', 'name' => 'fullname'],
            ['data' => 'avatar', 'name' => 'avatar'],
            ['data' => 'email', 'name' => 'email'],
            ['data' => 'phone', 'name' => 'phone'],
            ['data' => 'action', 'name' => 'href', 'orderable' => 0],
        ];
        return $this->returnResponse(200, $column);
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
            \DB::RAW("CONCAT(first_name,' ',last_name) as fullname"),
            'email',
            'phone',
            'avatar'
        );
        if (!isNullAndEmpty($req->search['field']) && !isNullAndEmpty($req->search['keyword'])) {
            if ($req->search['field'] == 'fullname') {
                $data = $data->where(\DB::RAW("CONCAT(first_name,' ',last_name)"), $operator, "%{$req->search['keyword']}%");
            } else {
                $data = $data->where(\DB::RAW($req->search['field']), $operator, "%{$req->search['keyword']}%");
            }
        }

        $dataTable = datatables($data);
        $dataTable = $this->addActionColumn($dataTable);
        $dataTable = $this->modifyImageAttribute($dataTable);
        return $dataTable->rawColumns(['avatar', 'action'])->make(true);
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
     * Modify Image attribute
     *
     * @param Datatable $dataTable
     * @return Datatable $dataTable
     **/
    public function modifyImageAttribute($dataTable)
    {
        return $dataTable->editColumn('avatar', function ($data) {
            return view('layout.image', ['url' => 'http://' . $data->avatar])->render();
        });
    }
}
