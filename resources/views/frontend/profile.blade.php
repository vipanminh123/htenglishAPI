@extends('layouts.frontend')

@section('title', 'Profile Page')

@section('body_class', 'profile-page')

@section('content')

<div class="col-sm-10 col-sm-offset-1">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h1 class="text-center">Profile</h1>
        </div>
        <div class="ibox-content">
            <form method="POST" class="form-horizontal" action="/profile/update">
                {{ csrf_field() }}

                <div class="form-group">
			        <label class="col-sm-2 control-label">Name:</label>
			        <div class="col-sm-10">
			            <input type="text" name="name" value="{{ old('name') ? old('name') : $user->name }}" class="form-control" required>
			        </div>
			    </div>
			    <div class="hr-line-dashed"></div>

			    <div class="form-group">
			        <label class="col-sm-2 control-label">Email Address:</label>
			        <div class="col-sm-10">
			            <input type="text" value="{{ $user->email }}" class="form-control" readonly>
			        </div>
			    </div>
			    <div class="hr-line-dashed"></div>

			    <div class="form-group">
			        <label class="col-sm-2 control-label">New Password:</label>
			        <div class="col-sm-10">
			            <input type="password" name="new_password" value="" class="form-control">
			        </div>
			    </div>
			    <div class="hr-line-dashed"></div>

			    <div class="form-group">
			        <label class="col-sm-2 control-label">Confirm Password:</label>
			        <div class="col-sm-10">
			            <input type="password" name="confirm_password" value="" class="form-control">
			        </div>
			    </div>
			    <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary dim" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection