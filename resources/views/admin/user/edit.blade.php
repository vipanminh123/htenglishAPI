@extends('layouts.admin')

	@php $user = isset($user) ? $user : false ; @endphp

@section('title')
	 Admin Page {{ $user ? "Edit" : "Create" }}  User
@endsection

@section('title-page')
	{{ $user ? "Edit" : "Create" }} User
@endsection

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <a href="/admin/user">User</a>
</li>
<li>
    <strong>{{ $user ? "Edit" : "Create" }}</strong>
</li>
@endsection

@section('body_class')
	admin-{{ $user ? "edit" : "create" }}-user-page
@endsection

@section('content')

<div class="ibox-content">

	

	<form method="post" class="form-horizontal" action="/admin/user/update">

		{{ csrf_field() }}

		<input type="hidden" name="id" value="{{ $user ? $user->id : '' }}">

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Name</label>
	        <div class="col-sm-10">
	            <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : $user ? $user->name : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Email</label>
	        <div class="col-sm-10">
	            <input type="email" name="email" value="{{ old('email') ? old('email') : $user ? $user->email : '' }}" class="form-control" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">{{$user ? 'New ' : ''}}Password</label>
	        <div class="col-sm-10">
	            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Confirm Password</label>
	        <div class="col-sm-10">
	            <input type="password" name="confirm_password" value="{{ old('confirm_password') }}" class="form-control">
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Avatar</label>
	        <div class="col-sm-10 wrapper-file-upload" data-cat="image">
	        	<div class="input-group">
		            <input type="text" name="avatar" value="{{ old('avatar') ? old('avatar') : $user ? $user->avatar : '' }}" class="form-control url_file_upload" id="url_file_upload" readonly>
		            <span class="input-group-btn">
		            	@php $url = asset('/public/Filemanager/index.html'); @endphp
		            	<button type="button" class="btn btn-success" onclick="BrowseServer('{{$url}}', 'url_file_upload');"><i class="fa fa-upload"></i></button> 
		            </span>
		            <span class="input-group-btn">
		            	<button type="button" class="btn btn-danger delete_url_file_upload"><i class="fa fa-times"></i></button> 
		            </span>
	            </div>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Roles</label>
	        <div class="col-sm-10">
	        	@foreach ($roles as $role)
		            <div class="checkbox checkbox-primary">
	                    <input id="{{$role->name}}"name="roles[]" type="checkbox" {{ $user ? ($user->hasRole($role->name) ? 'checked' : '') : '' }} value="{{$role->name}}">
	                    <label for="{{$role->name}}">{{$role->display_name}}</label>
	                </div>
                @endforeach
            </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <div class="col-sm-4 col-sm-offset-2">
	        	<a href="/admin/user"><button class="btn btn-default dim" type="button">Back</button></a>
	            <button class="btn btn-primary dim" type="submit">Save changes</button>
	        </div>
	    </div>
	</form>
</div>

@endsection