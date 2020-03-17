@extends('layouts.admin')

@section('title', 'Admin Page User')

@section('title-page', 'User')

@section('breadcrumb')
<li class="active">
    <a href="/admin">Admin</a>
</li>
<li>
    <strong>User</strong>
</li>
@endsection

@section('body_class', 'admin-user-page')

@section('content')

<div class="ibox-content">

	<a href="/admin/user/create" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Add User</a>

	<table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($users as $user)
				<tr>
					<td>{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->email}}</td>
					<td>
						@if ($user->avatar)
							<img src="/public/{{$user->avatar}}" width="50px">
						@endif
					</td>
					<td>
						<a href="/admin/user/edit/{{$user->id}}" class="btn btn-success">Edit</a>
						<a href="/admin/user/delete/{{$user->id}}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>
</div>

@endsection