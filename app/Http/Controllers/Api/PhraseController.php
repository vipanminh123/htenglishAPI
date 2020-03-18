<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phrases;
use App\User;
use JWTAuth;
use App\Models\Categories_phrases;

class PhraseController extends Controller
{
    public function getAllPhrase()
    {
        $phrases = Phrases::orderBy('english', 'asc')->get();
        return response()->json($phrases);
    }
    
    public function getAllPhraseOutStorage(Request $request) {
        $user = JWTAuth::toUser($request->input('token'));

    	$user_phrases = $user->phrases;
    	$arr = [];
    	foreach ($user_phrases as $val) {
    		$arr[] = $val->pivot->phrase_id;
    	}

    	$cat_phrases = Categories_phrases::all();
    	$phrases = Phrases::whereNotIn('id',  $arr)->orderBy('english', 'asc')->get();
        return response() ->json([
            'phrases' => $phrases,
            'cat_phrases' => $cat_phrases
        ]);
    }

    public function addToStorage(Request $request) 
    {
    	$phrase_id = $request->get('id');
        $user = JWTAuth::toUser($request->get('token'));
        $phrase = Phrases::where('id', $phrase_id)->first();
        $user->phrases()->attach($phrase);
        
    	$user_phrases = $user->phrases;
    	$arr = [];
    	foreach ($user_phrases as $val) {
    		$arr[] = $val->pivot->phrase_id;
        }
        $phrases = Phrases::whereNotIn('id',  $arr)->orderBy('english', 'asc')->get();

        return response()->json($phrases);
    }

    public function storage(Request $request) 
    {
    	$user = JWTAuth::toUser($request->get('token'));
    	$user_phrases = $user->phrases;
    	$arr = [];
    	foreach ($user_phrases as $val) {
    		$arr[] = $val->pivot->phrase_id;
    	}
    	
    	$cat_phrases = Categories_phrases::all();
        
    	$phrases = Phrases::whereIn('id',  $arr)->orderBy('english', 'asc')->get();
        return response() ->json([
            'phrases' => $phrases,
            'cat_phrases' => $cat_phrases
        ]);
    }

    public function remove(Request $request) 
    {
    	$phrase_id = $request->get('id');
        $user = JWTAuth::toUser($request->get('token'));
        $phrase = Phrases::where('id', $phrase_id)->first();
        $user->phrases()->detach($phrase);	
        
        $user_phrases = $user->phrases;
    	$arr = [];
    	foreach ($user_phrases as $val) {
    		$arr[] = $val->pivot->phrase_id;
    	}
    	
    	$cat_phrases = Categories_phrases::all();
        
    	$phrases = Phrases::whereIn('id',  $arr)->orderBy('english', 'asc')->get();
        return response() ->json($phrases);
    }

    public function learn(Request $request) 
    {
    	$user = JWTAuth::toUser($request->get('token'));
    	$phrases = $user->phrases()->inRandomOrder()->get();
    	return response() ->json($phrases);
    }

}
