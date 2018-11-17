<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';
    protected $casts = ['id' => 'string'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'email',
        'phone',
        'logo',
        'name',
        'website',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function scopeJoinUser($query)
    {
        return $query->join('user_organization', 'organizations.id', '=', 'user_organization.organization_id');
    }
}
