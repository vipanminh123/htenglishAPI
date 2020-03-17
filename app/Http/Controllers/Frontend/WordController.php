<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Word;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class WordController extends Controller
{
    public function __construct() 
    {
    	$this->middleware('auth');
    }

    public function index(Request $request) 
    {
    	$user = \Auth::user();
    	$user_words = $user->words;
    	$arr = [];
    	foreach ($user_words as $val) {
    		$arr[] = $val->pivot->word_id;
    	}

    	$words = Word::whereNotIn('id',  $arr)->orderBy('english', 'asc')->get();
        return view('frontend.words.home', compact('words'));
    }

    public function add(Request $request) 
    {
    	if($request->get('word_id')) {
    		$arr_word = $request->get('word_id');
    		$user = Auth::user();
    		foreach ($arr_word as $value) {
	    		$word = Word::where('id', $value)->first();
	    		$user->words()->attach($word);
	    	}
	    	Session::flash('success', 'Add to storage successfully!');
	    	return redirect('/word');    	
    	}
    	else {
    		return redirect('/word');
    	}
    }

    public function storage(Request $request) 
    {
    	$user = Auth::user();
    	$user_words = $user->words;
    	$arr = [];
    	foreach ($user_words as $val) {
    		$arr[] = $val->pivot->word_id;
    	}
    	
    	$words = Word::whereIn('id',  $arr)->orderBy('english', 'asc')->get();
        return view('frontend.words.storage', compact('words'));
    }

    public function remove(Request $request) 
    {
    	if($request->get('word_id')) {
    		$arr_word = $request->get('word_id');
    		$user = Auth::user();
    		foreach ($arr_word as $value) {
	    		$word = Word::where('id', $value)->first();
	    		$user->words()->detach($word);
	    	}
	    	Session::flash('success', 'Remove Word successfully!');
	    	return redirect('/word/storage');    	
    	}
    	else {
    		return redirect('/word/storage');	
    	}
    }

    public function engtoviet() 
    {
    	$user = Auth::user();
    	$words = $user->words()->inRandomOrder()->get();
    	return view('frontend.words.engtoviet', compact('words'));
    }

    public function viettoeng() 
    {
    	$user = Auth::user();
    	$words = $user->words()->inRandomOrder()->get();
    	return view('frontend.words.viettoeng', compact('words'));
    }

    public static function get_four_words($id) {
    	$word = Word::where('id', $id)->first();
    	$words = Word::where('id', '<>', $id)->inRandomOrder()->take(4)->get();
    	$words[] = $word;   
    	
    	$words = iterator_to_array($words, true);
    	shuffle($words);
    	return $words;
    }
}
