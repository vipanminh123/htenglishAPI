@extends('layouts.frontend')

@section('title','Phrase Storage Page')

@section('add-style')
    
    <link href="{{URL::asset('public/assets/css/datatables.min.css')}}" rel="stylesheet">

    <style>
        audio {
            width: 140px;
        }
    </style>
@endsection

@section('body_class', 'phrase-storage-page show-sidebar')

@section('content')

    <div class="col-md-9">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1 class="text-center">Phrases Storage</h1>
            </div>
            <div class="ibox-content">
                <form method="GET" action="/phrases/storage">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Filter by:</label>
                        <div class="col-sm-10 m-b">
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
                <form method="POST" action="/phrases/remove" class="form-horizontal">
                    {{ csrf_field() }}

                    <input type="hidden" name='old_request' value="" id="old_request" />

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
                            @foreach ($phrases as $phrase)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $phrase->english }}</td>
                                    <td>{{ $phrase->vietnamese }}</td>
                                    <td>
                                        <audio controls controlsList="nodownload">
                                            <source src="/public/{{ $phrase->audio_normal }}" type="audio/mpeg">
                                        </audio>
                                    </td>
                                    <td>
                                        
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" class="onoffswitch-checkbox" id="example-{{$phrase->id}}"  name="phrase_id[]" value="{{$phrase->id}}">
                                                <label class="onoffswitch-label" for="example-{{$phrase->id}}">
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
                            <button class="btn btn-primary dim" type="submit"><i class="fa fa-floppy-o"></i> Remove Phrase</button>
                        </div>
                        <div class="col-sm-4 col-sm-offset-4 text-right">
                            <a href="/phrases/learn/engtoviet"><button class="btn btn-success dim" type="button">Learn Phrase <i class="fa fa-arrow-right"></i></button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('phrases-storage', 'active')

@section('add-script')
    <!-- Datatables -->
    <script src="{{URL::asset('public/assets/js/datatables.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#editable').DataTable();
            
            var url      = window.location.href;
            var old_request = url.split("?")['1'];
            $("#old_request").val(old_request);
        });
    </script>
@endsection