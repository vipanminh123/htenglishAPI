@extends('layouts.admin')

	@php $permission = isset($permission) ? $permission : false ; @endphp

@section('title')
	 Admin Page {{ $permission ? "Edit" : "Create" }}  Permission
@endsection

@section('title-page')
	{{ $permission ? "Edit" : "Create" }} Permission
@endsection

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <a href="/admin/permission">Permission</a>
</li>
<li>
    <strong>{{ $permission ? "Edit" : "Create" }}</strong>
</li>
@endsection

@section('body_class')
	admin-{{ $permission ? "edit" : "create" }}-permission-page
@endsection

@section('content')

<div class="ibox-content">

	

	<form method="post" class="form-horizontal" action="/admin/permission/update">

		{{ csrf_field() }}

		<input type="hidden" name="id" value="{{ $permission ? $permission->id : '' }}">

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Name</label>
	        <div class="col-sm-10">
	            <input type="text" name="name" class="form-control" value="{{ $permission ? $permission->name : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Display Name</label>
	        <div class="col-sm-10">
	            <input type="text" name="display_name" value="{{ $permission ? $permission->display_name : '' }}" class="form-control" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Description</label>
	        <div class="col-sm-10">
	            <input type="text" name="description" value="{{ $permission ? $permission->description : '' }}" class="form-control">
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <div class="col-sm-4 col-sm-offset-2">
	        	<a href="/admin/permission"><button class="btn btn-default dim" type="button">Back</button></a>
	            <button class="btn btn-primary dim" type="submit">Save changes</button>
	        </div>
	    </div>
	</form>
</div>

@endsection