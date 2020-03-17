@extends('layouts.admin')

@section('title', 'Admin Page Lesson')

@section('add-style')
    <link href="{{URL::asset('public/assets/css/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('title-page', 'Lessons')

@section('breadcrumb')
<li>
    <a href="/admin">Admin</a>
</li>
<li>
    <strong>Lesson</strong>
</li>
@endsection

@section('body_class', 'admin-lesson-page')

@section('content')

<div class="ibox-content">

	<a href="/admin/lesson/create" class="btn btn-primary btn-lg" style="margin-bottom: 20px;">Add Lesson</a>

	<table class="table table-striped table-bordered table-hover" id="editable">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Featured Image</th>
                <th>Level</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessons as $lesson)
                <tr>
                    <td>{{$lesson->id}}</td>
                    <td>{{$lesson->title}}</td>
                    <td>
                        @if ($lesson->featured_image)
                            <img src="/public/{{ $lesson->featured_image }}" style="max-width: 150px">
                        @endif
                    </td>
                    <td>{{$lesson->level}}</td>
                    <td style="width: 125px;">
                        <a href="/admin/lesson/edit/{{$lesson->id}}" class="btn btn-success">Edit</a>
                        <a href="/admin/lesson/delete/{{$lesson->id}}" class="btn btn-danger">Delete</a>
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