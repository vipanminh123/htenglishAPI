<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function __construct() 
    {
    	$this->middleware('auth');
    }

    public function index() 
    {
    	$lessons = Lesson::orderBy('id', 'asc')->get();
    	return view('frontend.lessons.home', compact('lessons'));
    }

    public function learn($alias) {
        $lesson = Lesson::where('alias', $alias)->first();
    	return view('frontend.lessons.learn', compact('lesson'));
    }

    public static function clean_value($value) {
        $value = str_replace("’", "'", $value);
        return $value;
    }
}
