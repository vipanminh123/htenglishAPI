<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$users = User::all();
        return view('admin.user.home', compact('users'));
    }

    public function create() {
    	$roles = Role::all();
    	return view('admin.user.edit', compact('roles'));
    }

    public function edit($id) {
    	$user = User::find($id);
    	$roles = Role::all();
    	return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request) {
    	if(!$request->input('id')) {
    		$check = User::where('email', $request->input('email'))->first();
    		if($check) {
    			Session::flash('error', 'User failed to save successfully!');
    			return redirect('/admin/user/create');
    		}

    		$arr_req = $request->all();

    		if($arr_req['password'] == $arr_req['confirm_password']) {
    			$password = Hash::make($arr_req['password']);
    		}   		
    		else {
    			Session::flash('error', 'User failed to save successfully!');
    			return redirect('/admin/user/create');
    		}
    		
    		$user = User::create([
    			'name' => $arr_req['name'], 
    			'email' => $arr_req['email'], 
    			'password' => $password,
    		]);
 
            if(!empty($arr_req['roles'])) {
        		foreach ($arr_req['roles'] as $value) {
        			$role = Role::where('name', $value)->first();
    				$user->roles()->attach($role);
        		}
            }
    		
    		$user->avatar = $arr_req['avatar'];
    		$user->save();

    		Session::flash('success', 'User saved successfully!');
    		
    		return redirect('/admin/user/edit/'.$user->id);
    	}
    	else {
    		$user = User::findOrFail($request->input('id'));

    		$user->name = $request->get('name');
    		$user->email = $request->get('email');
    		$user->avatar = $request->get('avatar');
    		if($request->get('password') != '' && $request->get('password') == $request->get('confirm_password')) {
    			$user->password = Hash::make($request->get('password'));
    		}
    		$user->detachRoles($user->roles);

            if(!empty($request->get('roles'))) {
        		foreach ($request->get('roles') as $value) {
        			if(!$user->hasRole($value)) {
        				$role = Role::where('name', $value)->first();
        				$user->attachRole($role);
        			}
        		}
            }

    		$user->save();

    		Session::flash('success', 'User saved successfully!');

    		return redirect('/admin/user/edit/'.$user->id);
    	}
    }

    public function delete($id) {
    	$user = User::findOrFail($id);
    	$user->delete();

    	$user->roles()->sync([]); // Delete relationship data
        $user->phrases()->sync([]);
        $user->words()->sync([]);

    	Session::flash('success', 'Delete successfully!');

    	return redirect('admin/user');
    }
}
