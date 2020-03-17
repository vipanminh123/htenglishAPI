@extends('layouts.admin')

@section('title', 'Admin Page Phrases')

@section('add-style')
    <link href="{{URL::asset('public/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('title-page', 'Phrases')

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <strong>Phrases</strong>
</li>
@endsection

@section('body_class', 'admin-phrases-page')

@section('content')

<div class="ibox-content">

	<a href="/admin/phrases/create" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Add Phrases</a>

	<div class="">
		<form method="get" class="form-horizontal" action="/admin/phrases">
			{{ csrf_field() }}

			<div class="form-group">
		        <label class="col-sm-2 control-label">Filter by:</label>
		        <div class="col-sm-10">
		        	<div class="input-group">
						<select class="form-control m-b filter_by_cat_phrase" name="filter">
							<option value="all">All</option>
							@foreach ($cat_phrases as $cat)
								<option value="{{ $cat->id }}" {{ isset($filter) && $cat->id == $filter ? 'selected' : '' }}>{{ $cat->description }}</option>
							@endforeach
						</select>
						<span class="input-group-btn"> <button type="submit" class="btn btn-primary">Go!</button> </span>
					</div>
		        </div>
		    </div>
		</form>
	</div>

	<table class="table table-striped table-bordered table-hover" id="editable">
        <thead>
            <tr>
                <th>Id</th>
                <th>English</th>
                <th>Vietnamese</th>
                <th>Categories</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($phrases as $phrase)
				<tr>
					<td>{{$phrase->id}}</td>
					<td>{{$phrase->english}}</td>
					<td>{{$phrase->vietnamese}}</td>
					<td>
						@php 
							$cat = $phrase->Categories_phrases;
						@endphp
						<p>{{ $cat->description }}</p>
					</td>
					<td style="width: 125px;">
						<a href="/admin/phrases/edit/{{$phrase->id}}" class="btn btn-success">Edit</a>
						<a href="/admin/phrases/delete/{{$phrase->id}}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
        </tbody>
    </table>
</div>

@endsection

@section('add-script')
    <script src="{{URL::asset('public/assets/js/datatables.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#editable').DataTable();
        });
    </script>
@endsection