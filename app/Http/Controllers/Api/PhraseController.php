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
        // $userInfo = User::where('email', $user->email)->first();

    	$user_phrases = $user->phrases;
    	$arr = [];
    	foreach ($user_phrases as $val) {
    		$arr[] = $val->pivot->phrase_id;
    	}

    	$cat_phrases = Categories_phrases::all();
        if($request->input('filter') && $request->input('filter') != 'all') {
            $filter = $request->input('filter');
            $phrases = Categories_phrases::find($filter)->Phrases()->whereNotIn('id', $arr)->orderBy('english', 'asc')->get();
            return response()->json([
                'phrases' => $phrases,
                'filter' => $filter,
                'cat_phrases' => $cat_phrases
            ]);
        }
    	$phrases = Phrases::whereNotIn('id',  $arr)->orderBy('english', 'asc')->get();
        return response() ->json([
            'phrases' => $phrases,
            'cat_phrases' => $cat_phrases
        ]);
    }

}
