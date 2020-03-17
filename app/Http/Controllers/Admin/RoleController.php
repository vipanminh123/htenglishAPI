<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$roles = Role::all();
        return view('admin.role.home', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all();
    	return view('admin.role.edit', compact('permissions'));
    }

    public function edit($id) {
    	$role = Role::find($id);
        $permissions = Permission::all();
    	return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request) {
    	if(!$request->input('id')) {
    		$check = Role::where('name', $request->input('name'))->first();
    		if($check) {
    			Session::flash('error', 'Role failed to save successfully!');
    			return redirect('/admin/role/create');
    		}

    		$arr_req = $request->all();

            $role = Role::create([
                'name' => $arr_req['name'], 
                'display_name' => $arr_req['display_name'], 
            ]);
            if(!empty($arr_req['permissions'])) {
                foreach ($arr_req['permissions'] as $value) {
                    $permission = Permission::where('name', $value)->first();
                    $role->perms()->attach($permission);
                }
            }
 
    		$role->description = $arr_req['description'];
    		$role->save();

    		Session::flash('success', 'Role saved successfully!');
    		
    		return redirect('/admin/role/edit/'.$role->id);
    	}
    	else {
    		$role = Role::findOrFail($request->input('id'));
            
            $role->name = $request->get('name');
            $role->display_name = $request->get('display_name');
            $role->description = $request->get('description');

    		$role->detachPermissions($role->permission);

            if(!empty($request->get('permissions'))) { 
                foreach ($request->get('permissions') as $value) {
                    $permission = Permission::where('name', $value)->first();
                    $role->perms()->attach($permission);
                }
            }

            $role->save();

    		Session::flash('success', 'Role saved successfully!');

    		return redirect('/admin/role/edit/'.$role->id);
    	}
    }

    public function delete($id) {
    	$role = Role::findOrFail($id);
    	$role->delete();

    	$role->users()->sync([]); // Delete relationship data
		$role->perms()->sync([]); // Delete relationship data

		$role->forceDelete(); // Now force delete will work regardless of whether the pivot table has cascading delete

    	Session::flash('success', 'Delete successfully!');

    	return redirect('admin/role');
    }
}
