<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagementRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserOrganization;
use App\Traits\ResponseTraits;
use function GuzzleHttp\json_encode;
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
            $data = $this->model->JoinOrganization()->where('users.uuid', $uuid)->first();
            $data->organization = json_encode(['value' => $data->organization_id, 'text' => $data->organization_name]);
            $data->role = json_encode(['value' => $data->role_id, 'text' => $data->role_name]);
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
        if (@$data['avatar']) {
            $data['avatar'] = saveImageFromBase64($data['avatar']);
        } else {
            unset($data['avatar']);
        }
        if (!$data['uuid']) {
            $data = array_merge($data, ['username' => $data['email'], 'uuid' => (string) \Uuid::generate(4)]);
            \DB::beginTransaction();
            try {
                $role = new Role;
                $userOrganization = new UserOrganization;
                $role = $role->whereId($data['role'])->first();
                $user = \Sentinel::registerAndActivate($data);
                $role->users()->attach($user->id);
                $userOrganization = $userOrganization->create(['user_id' => $user->id, 'organization_id' => $data['organization'], 'uuid' => (string) \Uuid::generate(4)]);
                \DB::commit();
            } catch (\Exception $e) {
                dd($e->getMessage(), $e->getFile(), $e->getLine());
                \DB::rollback();
            }
        } else {
            $query = $this->model->with('roleUser', 'userOrganization')->where('uuid', $data['uuid']);
            $detail = $query->first();
            $detail->roleUser->role_id = $data['role'];
            $detail->roleUser->save();
            $detail->userOrganization->organization_id = $data['organization'];
            $detail->userOrganization->save();

            if ($detail->password == $data['password']) {
                unset($data['password']);
            } else {
                $data['password'] = \Hash::make($data['password']);
            }
            unset($data['role'], $data['organization']);
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
     * Datatable get Column
     *
     * @param Request $req
     * @return JSON Response
     **/
    public function getDatatableColumnOrganization(Request $req)
    {
        $column = [
            ['data' => 'full_name', 'name' => 'full_name'],
            ['data' => 'avatar', 'name' => 'avatar'],
            ['data' => 'email', 'name' => 'email'],
            ['data' => 'phone', 'name' => 'phone'],
            ['data' => 'role_name', 'name' => 'role_name'],
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
    public function datatableOrganization(Request $req)
    {
        $operator = $req->search['operator'] == 'equal' ? 'like' : 'not like';
        $data = $this->model->joinOrganization()->where('organizations.uuid', $req->uuid);
        if (!isNullAndEmpty($req->search['field']) && !isNullAndEmpty($req->search['keyword'])) {
            if ($req->search['field'] == 'fullname') {
                $data = $data->where(\DB::RAW("CONCAT(users.first_name,' ',users.last_name)"), $operator, "%{$req->search['keyword']}%");
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
            return view('layout.general-button', ['showOnly' => @\Sentinel::check()->userOrganization()->first()->organization_id == @$data->organization_id, 'viewPath' => $this->viewPath, 'data' => $data])->render();
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

    /**
     * Delete Record Menu From DB
     *
     * @param Request $req
     * @return JSON Response
     **/
    public function delete(UserManagementRequest $req)
    {
        $query = $this->model->where(['uuid' => $req->uuid]);
        deleteImageFromStorage(storage_path('app/public/' . str_replace(request()->getHttpHost() . '/storage/', '', $query->first()->avatar)));
        $query->delete();
        return $this->returnResponse(200, ['message' => trans('response.success.default')]);
    }

}
