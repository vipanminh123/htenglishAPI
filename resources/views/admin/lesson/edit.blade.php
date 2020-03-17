@extends('layouts.admin')

	@php $lesson = isset($lesson) ? $lesson : false ; @endphp

@section('title')
	 Admin Page {{ $lesson ? "Edit" : "Create" }}  Lesson
@endsection

@section('title-page')
	{{ $lesson ? "Edit" : "Create" }} Lesson
@endsection

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <a href="/admin/lesson">Lesson</a>
</li>
<li>
    <strong>{{ $lesson ? "Edit" : "Create" }}</strong>
</li>
@endsection

@section('body_class')
	admin-{{ $lesson ? "edit" : "create" }}-lesson-page
@endsection

@section('content')

<div class="ibox-content">


	<form method="post" class="form-horizontal" action="/admin/lesson/update">

		{{ csrf_field() }}

		<input type="hidden" name="id" value="{{ $lesson ? $lesson->id : '' }}">

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Title</label>
	        <div class="col-sm-10">
	            <input type="text" name="title" class="form-control" value="{{ old('title') ? old('title') : $lesson ? $lesson->title : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Alias</label>
	        <div class="col-sm-10">
	            <input type="text" name="alias" value="{{ old('alias') ? old('alias') : $lesson ? $lesson->alias : '' }}" class="form-control">
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Featured Image</label>
	        <div class="col-sm-10 wrapper-file-upload" data-cat="image">
	        	<div class="input-group">
		            <input type="text" name="featured_image" value="{{ old('featured_image') ? old('featured_image') : $lesson ? $lesson->featured_image : '' }}" class="form-control url_file_upload" id="url_file_upload" readonly>
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
	        <label class="col-sm-2 control-label">Audio</label>
	        <div class="col-sm-10 wrapper-file-upload" data-cat="audio">
	            <div class="input-group">
		            <input type="text" name="audio" value="{{ old('audio') ? old('audio') : $lesson ? $lesson->audio : '' }}" class="form-control url_file_upload" id="url_file_upload_2" readonly="">
		            <span class="input-group-btn">
		            	@php $url = asset('/public/Filemanager/index.html'); @endphp
		            	<button type="button" class="btn btn-success" onclick="BrowseServer('{{$url}}', 'url_file_upload_2');"><i class="fa fa-upload"></i></button> 
		            </span>
		            <span class="input-group-btn">
		            	<button type="button" class="btn btn-danger delete_url_file_upload"><i class="fa fa-times"></i></button> 
		            </span>
	            </div>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Character 1</label>
	        <div class="col-sm-10">
	            <input type="text" name="character1" class="form-control" value="{{ old('character1') ? old('character1') : $lesson ? $lesson->character1 : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Character 2</label>
	        <div class="col-sm-10">
	            <input type="text" name="character2" class="form-control" value="{{ old('character2') ? old('character2') : $lesson ? $lesson->character2 : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">English</label>
	        <div class="col-sm-10 lesson_english">
	        	@if ($lesson)
	        		@php $eng_in = 1; @endphp
	        		@foreach (json_decode($lesson->english) as $eng_val)	
	        			@if ($eng_in == 1)
	        				<input type="text" name="english[]" class="form-control m-b" value="{{ $eng_val }}" required>		
	        			@else
				            <div class="input-group m-b">
					            <input type="text" name="english[]" class="form-control m-b" value="{{ $eng_val }}" required>
					            <span class="input-group-btn">
					            	<button type="button" class="btn btn-danger delete_input_lesson"><i class="fa fa-times"></i></button> 
					            </span>
				            </div>
				        @endif
				        @php $eng_in++ ; @endphp
	            	@endforeach
	            @else	            	
	            	<input type="text" name="english[]" class="form-control m-b" value="{{ old('english') ? old('english') : '' }}" required>
	            @endif
	        </div>
	        <div class="col-sm-10 col-sm-offset-2">
		        <button type="button" class="btn btn-block btn-primary btn-lg" id="add_input_to_groups_english"><i class="fa fa-plus"></i></button>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Vietnamese</label>
	        <div class="col-sm-10 lesson_vietnamese">
	        	@if ($lesson)
	        		@php $viet_in = 1; @endphp
	        		@foreach (json_decode($lesson->vietnamese) as $viet_val)	
	        			@if ($viet_in == 1)
	        				<input type="text" name="vietnamese[]" class="form-control m-b" value="{{ $viet_val }}" required>
	        			@else	
		            		<div class="input-group m-b">
					            <input type="text" name="vietnamese[]" class="form-control m-b" value="{{ $viet_val }}" required>
					            <span class="input-group-btn">
					            	<button type="button" class="btn btn-danger delete_input_lesson"><i class="fa fa-times"></i></button> 
					            </span>
				            </div>
				        @endif
				        @php $viet_in++ ; @endphp
            		@endforeach
	            @else	            	
	            	<input type="text" name="vietnamese[]" class="form-control m-b" value="{{ old('vietnamese') ? old('vietnamese') : '' }}" required>
	            @endif
	        </div>
	        <div class="col-sm-10 col-sm-offset-2">
		        <button type="button" class="btn btn-block btn-primary btn-lg" id="add_input_to_groups_vietnamese"><i class="fa fa-plus"></i></button>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Level</label>
	        <div class="col-sm-10">
	            <input type="text" name="level" class="form-control" value="{{ old('level') ? old('level') : $lesson ? $lesson->level : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Order</label>
	        <div class="col-sm-10">
	            <input type="text" name="order" class="form-control" value="{{ old('order') ? old('order') : $lesson ? $lesson->order : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <div class="col-sm-4 col-sm-offset-2">
	        	<a href="/admin/lesson"><button class="btn btn-default dim" type="button">Back</button></a>
	            <button class="btn btn-primary dim" type="submit">Save changes</button>
	        </div>
	    </div>
	</form>
</div>

@endsection
