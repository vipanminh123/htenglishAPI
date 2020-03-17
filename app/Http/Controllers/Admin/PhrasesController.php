<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phrases;
use App\Models\Categories_phrases;
use Illuminate\Support\Facades\Session;

class PhrasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $cat_phrases = Categories_phrases::all();
        if($request->input('filter') && $request->input('filter') != 'all') {
            $filter = $request->input('filter');
            $phrases = Categories_phrases::find($filter)->Phrases;
            return view('admin.phrases.home', compact('phrases', 'filter', 'cat_phrases'));
        }
    	$phrases = Phrases::all();
        return view('admin.phrases.home', compact('phrases', 'cat_phrases'));
    }

    public function create() {
        $cat_phrases = Categories_phrases::all();
    	return view('admin.phrases.edit', compact('cat_phrases'));
    }

    public function edit($id) {
    	$phrase = Phrases::find($id);
        $cat_phrases = Categories_phrases::all();
    	return view('admin.phrases.edit', compact('phrase', 'cat_phrases'));
    }

    public function update(Request $request) {
    	if(!$request->input('id')) {
    		$check = Phrases::where('alias', $request->input('alias'))->first();
    		if($check) {
    			Session::flash('error', 'Phrases failed to save successfully!');
    			return redirect('/admin/phrases/create');
    		}

    		$arr_req = $request->all();

            $phrase = new Phrases();
            $phrase->english = $arr_req['english'];
            $phrase->vietnamese = $arr_req['vietnamese'];
            if ($arr_req['alias'] != '') {
                $phrase->alias = $arr_req['alias'];
            }
            else {
                $str = str_replace(' ', '-', $arr_req['english']);
                $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
                $str = strtolower(preg_replace('/-+/', '-', $str));
                $phrase->alias = $str;
            }
            // $phrase->alias = $arr_req['alias'];
            $phrase->audio_slow = $arr_req['audio_slow'];
            $phrase->audio_normal = $arr_req['audio_normal'];
            $phrase->cat_phrase_id = $arr_req['cat_phrase_id'];

    		$phrase->save();

    		Session::flash('success', 'Phrases saved successfully!');
    		
    		return redirect('/admin/phrases/edit/'.$phrase->id);
    	}
    	else {
    		$phrase = Phrases::findOrFail($request->input('id'));

            $check = Phrases::where('alias', $request->get('alias'))->first();
            if($check && $phrase->alias != $check->alias) {
                Session::flash('error', 'Phrases failed to save successfully!');
                return redirect('/admin/phrases/edit/'.$phrase->id);
            }

            $phrase->update($request->all());

            $str = str_replace(' ', '-', $request->input('alias'));
            $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
            $str = strtolower(preg_replace('/-+/', '-', $str));           
            $phrase->alias = $str;
            
            $phrase->save();

    		Session::flash('success', 'Phrases saved successfully!');

    		return redirect('/admin/phrases/edit/'.$phrase->id);
    	}
    }

    public function delete($id) {
    	$phrase = Phrases::findOrFail($id);
    	$phrase->delete();

        $phrase->users()->sync([]);

    	Session::flash('success', 'Delete successfully!');

    	return redirect('admin/phrases');
    }

}
