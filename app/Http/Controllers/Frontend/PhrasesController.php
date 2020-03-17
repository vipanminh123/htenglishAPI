<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phrases;
use App\Models\Categories_phrases;
use App\User;
use Illuminate\Support\Facades\Session;

class PhrasesController extends Controller
{
    public function __construct() 
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) 
    {
    	$user = \Auth::user();
    	$user_phrases = $user->phrases;
    	$arr = [];
    	foreach ($user_phrases as $val) {
    		$arr[] = $val->pivot->phrase_id;
    	}

    	$cat_phrases = Categories_phrases::all();
        if($request->input('filter') && $request->input('filter') != 'all') {
            $filter = $request->input('filter');
            $phrases = Categories_phrases::find($filter)->Phrases()->whereNotIn('id', $arr)->orderBy('english', 'asc')->get();
            return view('frontend.phrases.home', compact('phrases', 'filter', 'cat_phrases'));
        }
    	$phrases = Phrases::whereNotIn('id',  $arr)->orderBy('english', 'asc')->get();
        return view('frontend.phrases.home', compact('phrases', 'cat_phrases'));
    }

    public function add(Request $request) 
    {
    	if($request->get('phrase_id')) {
    		$arr_phrase = $request->get('phrase_id');
    		$user = \Auth::user();
    		foreach ($arr_phrase as $value) {
	    		$phrase = Phrases::where('id', $value)->first();
	    		$user->phrases()->attach($phrase);
	    	}
	    	Session::flash('success', 'Add to storage successfully!');
	    	if($request->get('old_request')) {
	    		return redirect('/phrases?' . $request->get('old_request'));
	    	}
	    	else {
	    		return redirect('/phrases');
	    	}	    	
    	}
    	else {
    		if($request->get('old_request')) {
	    		return redirect('/phrases?' . $request->get('old_request'));
	    	}
	    	else {
	    		return redirect('/phrases');
	    	}	
    	}
    }

    public function storage(Request $request) 
    {
    	$user = \Auth::user();
    	$user_phrases = $user->phrases;
    	$arr = [];
    	foreach ($user_phrases as $val) {
    		$arr[] = $val->pivot->phrase_id;
    	}
    	
    	$cat_phrases = Categories_phrases::all();
        if($request->input('filter') && $request->input('filter') != 'all') {
            $filter = $request->input('filter');
            $phrases = Categories_phrases::find($filter)->Phrases()->whereIn('id', $arr)->orderBy('english', 'asc')->get();
            return view('frontend.phrases.storage', compact('phrases', 'filter', 'cat_phrases'));
        }
    	$phrases = Phrases::whereIn('id',  $arr)->orderBy('english', 'asc')->get();
        return view('frontend.phrases.storage', compact('phrases', 'cat_phrases'));
    }

    public function remove(Request $request) 
    {
    	if($request->get('phrase_id')) {
    		$arr_phrase = $request->get('phrase_id');
    		$user = \Auth::user();
    		foreach ($arr_phrase as $value) {
	    		$phrase = Phrases::where('id', $value)->first();
	    		$user->phrases()->detach($phrase);
	    	}
	    	Session::flash('success', 'Remove Phrase successfully!');
	    	if($request->get('old_request')) {
	    		return redirect('/phrases/storage?' . $request->get('old_request'));
	    	}
	    	else {
	    		return redirect('/phrases/storage');
	    	}	    	
    	}
    	else {
    		if($request->get('old_request')) {
	    		return redirect('/phrases/storage?' . $request->get('old_request'));
	    	}
	    	else {
	    		return redirect('/phrases/storage');
	    	}	
    	}
    }

    public function engtoviet() 
    {
    	$user = \Auth::user();
    	$phrases = $user->phrases()->inRandomOrder()->get();
    	return view('frontend.phrases.engtoviet', compact('phrases'));
    }

    public function viettoeng() 
    {
    	$user = \Auth::user();
    	$phrases = $user->phrases()->inRandomOrder()->get();
    	return view('frontend.phrases.viettoeng', compact('phrases'));
    }
}
