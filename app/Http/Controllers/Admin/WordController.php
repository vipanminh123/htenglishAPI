<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Support\Facades\Session;

class WordController extends Controller
{
    public function __construct() 
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$words = Word::all();
    	return view('admin.word.home', compact('words'));
    }


    public function create() {
    	return view('admin.word.edit');
    }

    public function edit($id) {
    	$word = Word::find($id);
    	return view('admin.word.edit', compact('word'));
    }

    public function update(Request $request) {
    	if(!$request->input('id')) {
    		$check = Word::where('alias', $request->input('alias'))->first();
    		if($check) {
    			Session::flash('error', 'Word failed to save successfully!');
    			return redirect('/admin/word/create');
    		}

    		$arr_req = $request->all();

            $word = new Word();
            $word->english = $arr_req['english'];
            $word->vietnamese = $arr_req['vietnamese'];
            if ($arr_req['alias'] != '') {
                $word->alias = $arr_req['alias'];
            }
            else {
                $str = str_replace(' ', '-', $arr_req['english']);
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
                $str = strtolower(preg_replace('/-+/', '-', $str));
                $word->alias = $str;
            }
            
            $word->audio = $arr_req['audio'];

    		$word->save();

    		Session::flash('success', 'Word saved successfully!');
    		
    		return redirect('/admin/word/edit/'.$word->id);
    	}
    	else {
    		$word = Word::findOrFail($request->input('id'));

            $check = Word::where('alias', $request->get('alias'))->first();
            if($check && $word->alias != $check->alias) {
                Session::flash('error', 'Word failed to save successfully!');
                return redirect('/admin/word/edit/'.$word->id);
            }

            $word->update($request->all());

            $str = str_replace(' ', '-', $request->input('alias'));
            $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
            $str = strtolower(preg_replace('/-+/', '-', $str));           
            $word->alias = $str;
            
            $word->save();

    		Session::flash('success', 'Word saved successfully!');

    		return redirect('/admin/word/edit/'.$word->id);
    	}
    }

    public function delete($id) {
    	$word = Word::findOrFail($id);
    	$word->delete();

        // $word->users()->sync([]);

    	Session::flash('success', 'Delete successfully!');

    	return redirect('admin/word');
    }

}
