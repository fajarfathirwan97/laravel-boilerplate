<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Notifications\Notifiable;

class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'uuid', 'username', 'phone', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function organization()
    {
        return $this->hasManyThrough(UserOrganization::class, Organization::class);
    }

    public function scopeJoinOrganization($query)
    {
        return $query
            ->select([
                'roles.name as role_name',
                'roles.id as role_id',
                \DB::RAW("CONCAT(users.first_name,' ',users.last_name) as full_name"),
                'users.email',
                'users.phone',
                'users.avatar'
            ])
            ->join('user_organization', 'users.id', '=', 'user_organization.user_id')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->join('roles', 'role_users.role_id', '=', 'roles.id');
    }
}
