@extends('layouts.frontend')

@section('title','Learn Lesson Page')

@section('body_class', 'learn-lesson-page show-sidebar')

@section('content')

<div class="col-sm-9">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h1 class="text-center">Lesson {{ $lesson->order }}: {{ $lesson->title }}</h1>
        </div>
        <div class="ibox-content form-horizontal">
            <div class="form-group">
                <label class="col-sm-2">Listen: </label>
                <div class="col-sm-10">    
                    <audio src="/public{{ $lesson->audio }}" preload="auto" />
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="false"> Write</a></li>
                    <li class=""><a  href="#tab-2" class="open-tab-click" aria-expanded="true" style="cursor: not-allowed">View Content</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            @if ($lesson->alias == 'introducing-a-friend')
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Michael</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-content">
                                        <input type="hidden" class="input-result" value="Robert, this is my friend, Mrs. Smith">
                                    </div>
                                    <div class="col-sm-2">
                                        <strong class="hidden hide-check-true">TRUE</strong>
                                        <strong class="hidden hide-check-false">FALSE</strong>
                                    </div>
                                    <label class="col-sm-10 col-sm-offset-2 hide-result hidden">Result: <span>Robert, this is my friend, Mrs. Smith</span></label>
                                </div>
                                <div class="hr-line-dashed"></div>
                            @endif
                            @php $i = 1; @endphp
                            @foreach (json_decode($lesson->english) as $val)
                                @php $val = App\Http\Controllers\Frontend\LessonController::clean_value($val); @endphp
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{ $i%2 == 0 ? $lesson->character2 : $lesson->character1 }}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-content">
                                        <input type="hidden" class="input-result" value="{{ $val }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <strong class="hidden hide-check-true">TRUE</strong>
                                        <strong class="hidden hide-check-false">FALSE</strong>
                                    </div>
                                    <label class="col-sm-10 col-sm-offset-2 hide-result hidden">Result: <span>{{ $val }}</span></label>
                                </div>
                                <div class="hr-line-dashed"></div>
                                @php $i++; @endphp
                            @endforeach
                            <div class="form-group">
                                <div class="col-sm-5 col-sm-offset-2">
                                    <button class="btn btn-success dim" type="button" id="button-check-result">Check</button>
                                    <button class="btn btn-primary dim hidden" type="button" id="button-show-result">Show Result</button>
                                    <label class="m-l" id="show-result-total"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            @if ($lesson->alias == 'introducing-a-friend')
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Michael</label>
                                    <div class="col-sm-10">
                                        <p class="lesson-english-content" style="color: #000">Robert, this is my friend, Mrs. Smith</p>
                                        <div class="lesson-vietnamese-content" style="color: blue">Robert, đây là bạn tôi, bà Smith</div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                            @endif
                            @php $j = 1; $arr_viet = json_decode($lesson->vietnamese); @endphp
                            @foreach (json_decode($lesson->english) as $key => $val)
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{ $j%2 == 0 ? $lesson->character2 : $lesson->character1 }}</label>
                                    <div class="col-sm-10">
                                        <p class="lesson-english-content" style="color: #000">{{ $val }}</p>
                                        <div class="lesson-vietnamese-content" style="color: blue">{{ $arr_viet[$key] }}</div>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                @php $j++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>    
</div>

@endsection

@section('add-script')
    <script src="/public/assets/js/audio.min.js"></script>

    <script>
        audiojs.events.ready(function() {
            var as = audiojs.createAll();
        });
    </script>
@endsection