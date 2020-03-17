@extends('layouts.admin')

@section('title', 'Admin Page Words')

@section('add-style')
    <link href="{{URL::asset('public/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('title-page', 'Words')

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <strong>Words</strong>
</li>
@endsection

@section('body_class', 'admin-words-page')

@section('content')

<div class="ibox-content">

	<a href="/admin/word/create" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Add Word</a>

	<table class="table table-striped table-bordered table-hover" id="editable">
        <thead>
            <tr>
                <th>Id</th>
                <th>English</th>
                <th>Vietnamese</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($words as $word)
				<tr>
					<td>{{$word->id}}</td>
					<td>{{$word->english}}</td>
					<td>{{$word->vietnamese}}</td>
					<td style="width: 125px;">
						<a href="/admin/word/edit/{{$word->id}}" class="btn btn-success">Edit</a>
						<a href="/admin/word/delete/{{$word->id}}" class="btn btn-danger">Delete</a>
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