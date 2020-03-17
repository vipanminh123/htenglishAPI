@extends('layouts.frontend')

@section('title','Learn Words Page - English to Vietnamese')

@section('add-style')

    <link href="{{URL::asset('public/assets/css/icheck.css')}}" rel="stylesheet">

    <style>
        audio {
            width: 140px;
            max-width: 100%;
        }
    </style>
@endsection

@section('body_class', 'word-english-to-vietnamese show-sidebar')

@section('content')

    <div class="col-md-9">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1 class="text-center">Learn Word: English to Vietnamese</h1>
            </div>
            <div class="ibox-content form-horizontal">
                
                @foreach ($words as $word)    
                    <div class="form-group">
                        <label class="col-sm-12">{{ $word->english }}</label>
                        <div class="col-sm-8 quest-item">
                            @php $arr_result = App\Http\Controllers\Frontend\WordController::get_four_words($word->id); @endphp
                            @foreach ($arr_result as $val)
                                <label class="checkbox-inline i-checks">
                                    <input type="radio" name="word_{{ $word->id }}" value="{{$val->vietnamese}}"> {{$val->vietnamese}} </label>
                            @endforeach
                            <!-- <input type="text" class="form-control input-content"> -->
                            <input type="hidden" class="input-result" value="{{ $word->vietnamese }}">
                        </div>
                        <div class="col-sm-2">
                            <audio controls controlsList="nodownload">
                                <source src="/public{{ $word->audio }}" type="audio/mpeg">
                            </audio>
                        </div>
                        <div class="col-sm-2">
                            <strong class="hidden hide-check-true">TRUE</strong>
                            <strong class="hidden hide-check-false">FALSE</strong>
                        </div>
                        <label class="col-sm-12 hide-result hidden m-t">Result: <span>{{ $word->vietnamese }}</span></label>
                    </div>
                    <div class="hr-line-dashed"></div>
                @endforeach

                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-2">
                        <button class="btn btn-success dim" type="button" id="button-check-result-word">Check</button>
                        <button class="btn btn-primary dim hidden" type="button" id="button-show-result">Show Result</button>
                        <label class="m-l" id="show-result-total"></label>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection

@section('words-engtoviet', 'active')

@section('learn-words', 'active')

@section('add-script')
    <!-- Datatables -->
    <script src="{{URL::asset('public/assets/js/icheck.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    
@endsection