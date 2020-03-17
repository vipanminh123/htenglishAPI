<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Support\Facades\Session;

class LessonController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
    	$lessons = Lesson::all();
        return view('admin.lesson.home', compact('lessons'));
    }

    public function create() {
    	return view('admin.lesson.edit');
    }

    public function edit($id) {
    	$lesson = Lesson::find($id);
        return view('admin.lesson.edit', compact('lesson'));
    }

    public function update(Request $request) {
    	if(!$request->input('id')) {
            $check = Lesson::where('alias', $request->input('alias'))->first();
            if($check) {
                Session::flash('error', 'Lesson failed to save successfully!');
                return redirect('/admin/lesson/create');
            }

            $arr_req = $request->all();
            $english = json_encode($arr_req['english']);
            $vietnamese = json_encode($arr_req['vietnamese']);

            $lesson = new Lesson();
            $lesson->title = $arr_req['title'];
            $lesson->featured_image = $arr_req['featured_image'];
            $lesson->audio = $arr_req['audio'];
            $lesson->character1 = $arr_req['character1'];
            $lesson->character2 = $arr_req['character2'];
            $lesson->english = $english;
            $lesson->vietnamese = $vietnamese;
            $lesson->level = $arr_req['level'];
            $lesson->order = $arr_req['order'];
            if ($arr_req['alias'] != '') {
                $lesson->alias = $arr_req['alias'];
            }
            else {
                $str = str_replace(' ', '-', $arr_req['title']);
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
                $str = strtolower(preg_replace('/-+/', '-', $str));
                $lesson->alias = $str;
            }
            

            $lesson->save();

            Session::flash('success', 'Lesson saved successfully!');
            
            return redirect('/admin/lesson/edit/'.$lesson->id);
        }
        else {
            $lesson = Lesson::findOrFail($request->input('id'));

            $check = Lesson::where('alias', $request->get('alias'))->first();
            if($check && $lesson->alias != $check->alias) {
                Session::flash('error', 'Lesson failed to save successfully!');
                return redirect('/admin/lesson/edit/'.$lesson->id);
            }

            $arr_req = $request->all();

            $lesson->title = $arr_req['title'];
            $lesson->featured_image = $arr_req['featured_image'];
            $lesson->audio = $arr_req['audio'];
            $lesson->character1 = $arr_req['character1'];
            $lesson->character2 = $arr_req['character2'];

            $english = json_encode($arr_req['english']);
            $vietnamese = json_encode($arr_req['vietnamese']);
            $lesson->english = $english;
            $lesson->vietnamese = $vietnamese;
            $lesson->level = $arr_req['level'];
            $lesson->order = $arr_req['order'];
            
            $str = str_replace(' ', '-', $request->input('alias'));
            $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
            $str = strtolower(preg_replace('/-+/', '-', $str));           
            $lesson->alias = $str;
            
            $lesson->save();

            Session::flash('success', 'Lesson saved successfully!');

            return redirect('/admin/lesson/edit/'.$lesson->id);
        }
    }

    public function delete($id) {
    	$lesson = Lesson::findOrFail($id);
        $lesson->delete();

        Session::flash('success', 'Delete successfully!');

        return redirect('admin/lesson');
    }
}
