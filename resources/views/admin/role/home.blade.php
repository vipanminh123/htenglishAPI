@extends('layouts.admin')

@section('title', 'Admin Page User Role')

@section('title-page', 'User-Role')

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <strong>Role</strong>
</li>
@endsection

@section('body_class', 'admin-user-role-page')

@section('content')

<div class="ibox-content">

	<a href="/admin/role/create" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Add Role</a>

	<table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($roles as $role)
				<tr>
					<td>{{$role->id}}</td>
					<td>{{$role->name}}</td>
					<td>{{$role->display_name}}</td>
					<td>
						<p>{{ $role->description }}</p>
					</td>
					<td>
						<a href="/admin/role/edit/{{$role->id}}" class="btn btn-success">Edit</a>
						<a href="/admin/role/delete/{{$role->id}}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>
</div>

@endsection