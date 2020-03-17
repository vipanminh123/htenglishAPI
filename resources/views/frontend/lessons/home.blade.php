@extends('layouts.frontend')

@section('title','Lesson Page')

@section('body_class', 'lesson-page show-sidebar')

@section('content')

<div class="col-sm-9">
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
                                    <div class="lesson-number">Lesson: {{ $lesson->order }}</div>
                                    <div class="lesson-title"><a href="/lesson/{{ $lesson->alias }}">{{ $lesson->title }}</a></div>
                                    <div class="lesson-level">Level: {{ $lesson->level }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>    
</div>

@endsection

@section('all-lessons', 'active')
