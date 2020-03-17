@extends('layouts.admin')

	@php $word = isset($word) ? $word : false ; @endphp

@section('title')
	 Admin Page {{ $word ? "Edit" : "Create" }}  Word
@endsection

@section('add-style')
	<link href="{{URL::asset('public/assets/css/chosen.css')}}" rel="stylesheet">
@endsection

@section('title-page')
	{{ $word ? "Edit" : "Create" }} Word
@endsection

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <a href="/admin/word">Word</a>
</li>
<li>
    <strong>{{ $word ? "Edit" : "Create" }}</strong>
</li>
@endsection

@section('body_class')
	admin-{{ $word ? "edit" : "create" }}-word-page
@endsection

@section('content')

<div class="ibox-content">

	

	<form method="post" class="form-horizontal" action="/admin/word/update">

		{{ csrf_field() }}

		<input type="hidden" name="id" value="{{ $word ? $word->id : '' }}">

	    <div class="form-group">
	        <label class="col-sm-2 control-label">English</label>
	        <div class="col-sm-10">
	            <input type="text" name="english" class="form-control" value="{{ old('english') ? old('english') : $word ? $word->english : '' }}" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Vietnamese</label>
	        <div class="col-sm-10">
	            <input type="text" name="vietnamese" value="{{ old('vietnamese') ? old('vietnamese') : $word ? $word->vietnamese : '' }}" class="form-control" required>
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Alias</label>
	        <div class="col-sm-10">
	            <input type="text" name="alias" value="{{ old('alias') ? old('alias') : $word ? $word->alias : '' }}" class="form-control">
	        </div>
	    </div>
	    <div class="hr-line-dashed"></div>

	    <div class="form-group">
	        <label class="col-sm-2 control-label">Audio</label>
	        <div class="col-sm-10 wrapper-file-upload" data-cat="audio">
	            <div class="input-group">
		            <input type="text" name="audio" value="{{ old('audio') ? old('audio') : $word ? $word->audio : '' }}" class="form-control url_file_upload" id="url_file_upload" readonly="">
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
	        <div class="col-sm-4 col-sm-offset-2">
	        	<a href="/admin/word"><button class="btn btn-default dim" type="button">Back</button></a>
	            <button class="btn btn-primary dim" type="submit">Save changes</button>
	        </div>
	    </div>
	</form>
</div>

@endsection

@section('add-script')
	<script src="{{URL::asset('public/assets/js/chosen.jquery.js')}}"></script>

	<script type="text/javascript">
		var config = {
	        '.chosen-select': {},
	        '.chosen-select-deselect': {
	            allow_single_deselect: true
	        },
	        '.chosen-select-no-single': {
	            disable_search_threshold: 10
	        },
	        '.chosen-select-no-results': {
	            no_results_text: 'Oops, nothing found!'
	        },
	        '.chosen-select-width': {
	            width: "95%"
	        }
	    }
	    for (var selector in config) {
	        $(selector).chosen(config[selector]);
	    }
	</script>
	
@endsection