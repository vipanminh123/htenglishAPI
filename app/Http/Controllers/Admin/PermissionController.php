<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$permissions = Permission::all();
        return view('admin.permission.home', compact('permissions'));
    }

    public function create() {
    	return view('admin.permission.edit');
    }

    public function edit($id) {
    	$permission = Permission::find($id);
    	return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request) {
    	if(!$request->input('id')) {
    		$check = Permission::where('name', $request->input('name'))->first();
    		if($check) {
    			Session::flash('error', 'Permissions failed to save successfully!'); 
    			return redirect('/admin/permission/create');
    		}

    		$arr_req = $request->all();
    		$permission = new Permission();
    		$permission->name = $arr_req['name'];
    		$permission->display_name = $arr_req['display_name'];
    		$permission->description = $arr_req['description'];
    		$permission->save();

    		Session::flash('success', 'Permissions saved successfully!');
    		
    		return redirect('/admin/permission/edit/'.$permission->id);
    	}
    	else {
    		$permission = Permission::findOrFail($request->input('id'));

    		$permission->update($request->all());

    		Session::flash('success', 'Permissions saved successfully!');

    		return redirect('/admin/permission/edit/'.$permission->id);
    	}
    }

    public function delete($id) {
    	$permission = Permission::find($id);
    	$permission->delete();
        
        $permission->roles()->sync([]);

    	Session::flash('success', 'Delete successfully!');

    	return redirect('admin/permission');
    }
}
