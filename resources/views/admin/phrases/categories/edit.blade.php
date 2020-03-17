@extends('layouts.admin')

	@php $cat_phrase = isset($cat_phrase) ? $cat_phrase : false ; @endphp

@section('title')
	 Admin Page {{ $cat_phrase ? "Edit" : "Create" }}  Categories Phrases
@endsection

@section('title-page')
	{{ $cat_phrase ? "Edit" : "Create" }} Categories Phrases
@endsection

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <a href="/admin/cat-phrases">Categories Phrases</a>
</li>
<li>
    <strong>{{ $cat_phrase ? "Edit" : "Create" }}</strong>
</li>
@endsection

@section('body_class')
	admin-{{ $cat_phrase ? "edit" : "create" }}-categories-phrases-page
@endsection

@section('content')

<div class="ibox-content">

	

	<form method="post" class="form-horizontal" action="/admin/cat-phrases/update">

		{{ csrf_field() }}

		<input type="hidden" name="id" value="{{ $cat_phrase ? $cat_phrase->id : '' }}">

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Name</label>
	        <div class="col-sm-10">
	            <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : $cat_phrase ? $cat_phrase->name : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Alias</label>
	        <div class="col-sm-10">
	            <input type="text" name="alias" value="{{ old('alias') ? old('alias') : $cat_phrase ? $cat_phrase->alias : '' }}" class="form-control" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Description</label>
	        <div class="col-sm-10">
	            <input type="text" name="description" value="{{ old('description') ? old('description') : $cat_phrase ? $cat_phrase->description : '' }}" class="form-control" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <div class="col-sm-4 col-sm-offset-2">
	        	<a href="/admin/cat-phrases"><button class="btn btn-default dim" type="button">Back</button></a>
	            <button class="btn btn-primary dim" type="submit">Save changes</button>
	        </div>
	    </div>
	</form>
</div>

@endsection
