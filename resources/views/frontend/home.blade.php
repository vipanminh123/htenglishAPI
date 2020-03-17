@extends('layouts.frontend')

@section('title','HomePage')

@section('add-style')
    
    <link href="{{URL::asset('public/assets/css/datatables.min.css')}}" rel="stylesheet">

    <style>
        audio {
            width: 140px;
        }
    </style>
@endsection

@section('body_class', 'homepage')

@section('content')

<div class="col-sm-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h1 class="text-center">100 English Lessons</h1>
        </div>
        <div class="ibox-content">
            <div class="row">
                @foreach ($lessons as $lesson)
                    <div class="col-sm-12">
                        <div class="lesson-block m-b gray-bg">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="/lesson/{{ $lesson->alias }}"><img src="/public/{{ $lesson->featured_image }}"></a>
                                </div>
                                <div class="col-sm-8 lesson-block-content">
                                    <div class="lesson-number">Lesson: {{ $lesson->id }}</div>
                                    <div class="lesson-title"><a href="/lesson/{{ $lesson->alias }}">{{ $lesson->title }}</a></div>
                                    <div class="lesson-level">Level: {{ $lesson->level }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center">
                <a href="/lesson" class="btn btn-success btn-lg">More</a>
            </div>
        </div>
    </div>    
</div>

<div class="col-md-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h1 class="text-center">1000 Most Common English Phrases</h1>
        </div>
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover"  id="editable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>English</th>
                        <th>Vietnamese</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($phrases as $phrase)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $phrase->english }}</td>
                            <td>{{ $phrase->vietnamese }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
                <a href="/phrases" class="btn btn-success btn-lg">Learn Phrase</a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h1 class="text-center">1000 Most Common English Words</h1>
        </div>
        <div class="ibox-content">
            <table class="table table-striped table-bordered table-hover"  id="editable2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>English</th>
                        <th>Vietnamese</th>
                    </tr>
                </thead>
                <tbody>
                    @php $j = 1; @endphp
                    @foreach ($words as $word)
                        <tr>
                            <td>{{ $j }}</td>
                            <td>{{ $word->english }}</td>
                            <td>{{ $word->vietnamese }}</td>
                        </tr>
                        @php $j++; @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
                <a href="/word" class="btn btn-success btn-lg">Learn Word</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('add-script')
    <!-- Datatables -->
    <script src="{{URL::asset('public/assets/js/datatables.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#editable').DataTable();
            $('#editable2').DataTable();
        });
    </script>
@endsection