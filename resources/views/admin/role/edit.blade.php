@extends('layouts.admin')

	@php $role = isset($role) ? $role : false ; @endphp

@section('title')
	 Admin Page {{ $role ? "Edit" : "Create" }}  Role
@endsection

@section('title-page')
	{{ $role ? "Edit" : "Create" }} Role
@endsection

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <a href="/admin/role">Role</a>
</li>
<li>
    <strong>{{ $role ? "Edit" : "Create" }}</strong>
</li>
@endsection

@section('body_class')
	admin-{{ $role ? "edit" : "create" }}-role-page
@endsection

@section('content')

<div class="ibox-content">

	

	<form method="post" class="form-horizontal" action="/admin/role/update">

		{{ csrf_field() }}

		<input type="hidden" name="id" value="{{ $role ? $role->id : '' }}">

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Name</label>
	        <div class="col-sm-10">
	            <input type="text" name="name" class="form-control" value="{{ $role ? $role->name : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Display Name</label>
	        <div class="col-sm-10">
	            <input type="text" name="display_name" value="{{ $role ? $role->display_name : '' }}" class="form-control" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Description</label>
	        <div class="col-sm-10">
	            <input type="text" name="description" value="{{ $role ? $role->description : '' }}" class="form-control">
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Permission</label>
	        <div class="col-sm-10">

	        	@foreach ($permissions as $permission)
	        		@php $check = ''; @endphp 
	        		
		            <div class="checkbox checkbox-primary">
		            	@if ($role)
			            	@foreach ($role->perms as $value)
						        @if ($value->name == $permission->name)
						        	@php $check = 'checked'; @endphp
						        @endif
						    @endforeach
					    @endif
	                    <input id="{{$permission->name}}"name="permissions[]" type="checkbox" {{ $check }} value="{{$permission->name}}">
	                    <label for="{{$permission->name}}">{{$permission->display_name}}</label>
	                </div>
                @endforeach
            </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <div class="col-sm-4 col-sm-offset-2">
	        	<a href="/admin/role"><button class="btn btn-default dim" type="button">Back</button></a>
	            <button class="btn btn-primary dim" type="submit">Save changes</button>
	        </div>
	    </div>
	</form>
</div>

@endsection