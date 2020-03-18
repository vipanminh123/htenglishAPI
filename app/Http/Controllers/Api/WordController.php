<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Word;
use App\User;
use JWTAuth;

class WordController extends Controller
{
    public function getAllWord()
    {
        $words = Word::orderBy('english', 'asc')->get();
        return response()->json($words);
    }
    
    public function getAllWordOutStorage(Request $request) {
        $user = JWTAuth::toUser($request->input('token'));

    	$user_words = $user->words;
    	$arr = [];
    	foreach ($user_words as $val) {
    		$arr[] = $val->pivot->word_id;
    	}

    	$words = Word::whereNotIn('id',  $arr)->orderBy('english', 'asc')->get();
        return response() ->json($words);
    }

    public function addToStorage(Request $request) 
    {
    	$id = $request->get('id');
        $user = JWTAuth::toUser($request->get('token'));
        $word = Word::where('id', $id)->first();
        $user->words()->attach($word);
        
    	$user_words = $user->words;
    	$arr = [];
    	foreach ($user_words as $val) {
    		$arr[] = $val->pivot->word_id;
        }
        $words = Word::whereNotIn('id',  $arr)->orderBy('english', 'asc')->get();

        return response()->json($words);
    }

    public function storage(Request $request) 
    {
    	$user = JWTAuth::toUser($request->get('token'));
    	$user_words = $user->words;
    	$arr = [];
    	foreach ($user_words as $val) {
    		$arr[] = $val->pivot->word_id;
    	}
    	
    	$words = Word::whereIn('id',  $arr)->orderBy('english', 'asc')->get();
        return response() ->json($words);
    }

    public function remove(Request $request) 
    {
    	$word_id = $request->get('id');
        $user = JWTAuth::toUser($request->get('token'));
        $word = Word::where('id', $word_id)->first();
        $user->words()->detach($word);	
        
        $user_words = $user->words;
    	$arr = [];
    	foreach ($user_words as $val) {
    		$arr[] = $val->pivot->word_id;
    	}
    	
    	$words = Word::whereIn('id',  $arr)->orderBy('english', 'asc')->get();
        return response() ->json($words);
    }

    public function learn(Request $request) 
    {
    	$user = JWTAuth::toUser($request->get('token'));
    	$words = $user->words()->inRandomOrder()->get();
    	return response() ->json($words);
    }

}
