@extends('layouts.frontend')

@section('title','Word Storage Page')

@section('add-style')
    
    <link href="{{URL::asset('public/assets/css/datatables.min.css')}}" rel="stylesheet">

    <style>
        audio {
            width: 140px;
        }
    </style>
@endsection

@section('body_class', 'word-storage-page show-sidebar')

@section('content')

    <div class="col-md-9">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1 class="text-center">Words Storage</h1>
            </div>
            <div class="ibox-content">
               
                <form method="POST" action="/word/remove" class="form-horizontal">
                    {{ csrf_field() }}

                    <table class="table table-striped table-bordered table-hover"  id="editable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>English</th>
                                <th>Vietnamese</th>
                                <th>Audio</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($words as $word)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $word->english }}</td>
                                    <td>{{ $word->vietnamese }}</td>
                                    <td>
                                        <audio controls controlsList="nodownload">
                                            <source src="/public/{{ $word->audio }}" type="audio/mpeg">
                                        </audio>
                                    </td>
                                    <td>
                                        
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" id="example-{{$word->id}}"  name="word_id[]" value="{{$word->id}}">
                                                <label class="onoffswitch-label" for="example-{{$word->id}}">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <button class="btn btn-primary dim" type="submit"><i class="fa fa-floppy-o"></i> Remove Word</button>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4 text-right">
                            <a href="/word/learn/engtoviet"><button class="btn btn-success dim" type="button">Learn Word <i class="fa fa-arrow-right"></i></button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('words-storage', 'active')

@section('add-script')
    <!-- Datatables -->
    <script src="{{URL::asset('public/assets/js/datatables.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#editable').DataTable();
        });
    </script>
@endsection