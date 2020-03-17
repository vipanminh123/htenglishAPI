<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function getAllLesson()
    {
        $lessons = Lesson::orderBy('id', 'asc')->get();
        return response()->json($lessons); 
    }
    
    public function learn($alias) {
        $lesson = Lesson::where('alias', $alias)->first();
        $lesson->english = json_decode($lesson->english);
        $lesson->vietnamese = json_decode($lesson->vietnamese);
    	return response()->json($lesson);
    }

}
