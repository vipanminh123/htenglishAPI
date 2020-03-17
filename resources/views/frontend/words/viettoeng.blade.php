@extends('layouts.frontend')

@section('title','Learn Word Page - Vietnamese to English')

@section('add-style')

    <style>
        audio {
            width: 140px;
            max-width: 100%;
        }
    </style>
@endsection

@section('body_class', 'word-vietnamese-to-english show-sidebar')

@section('content')

    <div class="col-md-9">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h1 class="text-center">Learn Word: Vietnamese to English</h1>
            </div>
            <div class="ibox-content form-horizontal">

                @foreach ($words as $word)    
                    <div class="form-group">
                        <label class="col-sm-12">{{ $word->vietnamese }}</label>
                        <div class="col-sm-8">
                            @php $leng = strlen($word->english); $a = str_repeat('a',$leng); @endphp
                            <input type="text" class="form-control input-content"  data-mask="{{ $a }}">
                            <input type="hidden" class="input-result" value="{{ $word->english }}">
                        </div>
                        <div class="col-sm-2">
                            <audio controls controlsList="nodownload">
                                <source src="/public/{{ $word->audio }}" type="audio/mpeg">
                            </audio>
                        </div>
                        <div class="col-sm-2">
                            <strong class="hidden hide-check-true">TRUE</strong>
                            <strong class="hidden hide-check-false">FALSE</strong>
                        </div>
                        <label class="col-sm-12 hide-result hidden">Result: <span>{{ $word->english }}</span></label>
                    </div>
                    <div class="hr-line-dashed"></div>
                @endforeach

                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-2">
                        <button class="btn btn-success dim" type="button" id="button-check-result">Check</button>
                        <button class="btn btn-primary dim hidden" type="button" id="button-show-result">Show Result</button>
                        <label class="m-l" id="show-result-total"></label>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

@endsection

@section('words-viettoeng', 'active')

@section('learn-words', 'active')

@section('add-script')
    <script src="{{URL::asset('public/assets/js/jasny-bootstrap.min.js')}}"></script>
    
@endsection