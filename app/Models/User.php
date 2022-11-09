<?php

namespace App\Models;

use App\Http\Controllers\Traits\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mpociot\Teamwork\Traits\UserHasTeams;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasPermissionsTrait,UserHasTeams;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if this user belongs to a role
     *
     * @return bool
     */
    public function hasRole($role_name)
    {
        foreach ($this->roles as $role) {

            //I assumed the column which holds the role name is called role_name
            if ($role->name == $role_name)
                return true;
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    // public function employees()
    // {
    //     return $this->belongsToMany(Employee::class);
    // }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_user');
    }

    public function companyWithName()
    {
        return $this->belongsToMany(Company::class, 'company_user')->pluck('company_name')->first();
    }

    public function companyID()
    {
        return $this->belongsToMany(Company::class, 'company_user')->pluck('id')->first();
    }
}
