<?php 
namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
	protected $fillable = ['name', 'display_name', 'description'];	

    /**
     * The roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'permission_role');
    }
}