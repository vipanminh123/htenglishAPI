<?php 
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	protected $fillable = ['name', 'display_name', 'description'];	

	/**
     * The user that belong to the role.
     */
	public function users()
	{
		return $this->belongsToMany('App\User', 'role_user');
	}

	/**
     * The permission that belong to the role.
     */
	public function permission()
	{
		return $this->belongsToMany('App\Permission', 'permission_role');
	}
}