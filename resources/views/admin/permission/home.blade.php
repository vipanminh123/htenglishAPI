@extends('layouts.admin')

@section('title', 'Admin Page User Permission')

@section('title-page', 'User-Permission')

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <strong>Permission</strong>
</li>
@endsection

@section('body_class', 'admin-user-permission-page')

@section('content')

<div class="ibox-content">

	<a href="/admin/permission/create" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Add Permission</a>

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
        	@foreach ($permissions as $permission)
				<tr>
					<td>{{$permission->id}}</td>
					<td>{{$permission->name}}</td>
					<td>{{$permission->display_name}}</td>
					<td>
						<p>{{ $permission->description }}</p>
					</td>
					<td>
						<a href="/admin/permission/edit/{{$permission->id}}" class="btn btn-success">Edit</a>
						<a href="/admin/permission/delete/{{$permission->id}}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>
</div>

@endsection