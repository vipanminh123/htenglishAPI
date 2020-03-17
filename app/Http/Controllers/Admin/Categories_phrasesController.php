<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories_phrases;
use Illuminate\Support\Facades\Session;

class Categories_phrasesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$cat_phrases = Categories_phrases::all();
        return view('admin.phrases.categories.home', compact('cat_phrases'));
    }

    public function create() {
    	return view('admin.phrases.categories.edit');
    }

    public function edit($id) {
    	$cat_phrase = Categories_phrases::find($id);
    	return view('admin.phrases.categories.edit', compact('cat_phrase'));
    }

    public function update(Request $request) {
    	if(!$request->input('id')) {
    		$check = Categories_phrases::where('alias', $request->input('alias'))->first();
    		if($check) {
    			Session::flash('error', 'Categories Phrases failed to save successfully!');
    			return redirect('/admin/cat-phrases/create');
    		}

    		$arr_req = $request->all();

            $cat_phrase = new Categories_phrases();
            $cat_phrase->name = $arr_req['name'];
            $cat_phrase->description = $arr_req['description'];
            $cat_phrase->alias = $arr_req['alias'];

    		$cat_phrase->save();

    		Session::flash('success', 'Categories Phrases saved successfully!');
    		
    		return redirect('/admin/cat-phrases/edit/'.$cat_phrase->id);
    	}
    	else {
    		$cat_phrase = Categories_phrases::findOrFail($request->input('id'));

    		$check = Categories_phrases::where('alias', $request->get('alias'))->first();
    		if($check && $cat_phrase->alias != $check->alias) {
    			Session::flash('error', 'Categories Phrases failed to save successfully!');
    			return redirect('/admin/cat-phrases/edit/'.$cat_phrase->id);
    		}
            
            $cat_phrase->update($request->all());

    		Session::flash('success', 'Categories Phrases saved successfully!');

    		return redirect('/admin/cat-phrases/edit/'.$cat_phrase->id);
    	}
    }

    public function delete($id) {
    	$cat_phrase = Categories_phrases::findOrFail($id);
    	$cat_phrase->delete();
    	// $cat_phrase->Phrases()->sync([]);

    	Session::flash('success', 'Delete successfully!');

    	return redirect('admin/cat-phrases');
    }
}
