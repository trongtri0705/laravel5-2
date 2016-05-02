<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id','facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $have_role = false;

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();

        // Check if the user is a root account
        if ($this->have_role && $this->have_role->name == 'Administrator') {
            return true;
        }

        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }

        return false;
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function checkIfUserHasRole($need_role)
    {
        return $this->have_role && (strtolower($need_role) == strtolower($this->have_role->name)) ? true : false;
    }

    public function isCustomer()
    {
        $this->have_role = $this->getUserRole();

        return $this->have_role->name == 'Customer' || $this->have_role->name == 'User';
    }
}
