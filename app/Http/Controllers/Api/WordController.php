<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Word;

class WordController extends Controller
{
    public function getAllWord()
    {
        $words = Word::orderBy('english', 'asc')->get();
        return response()->json($words);
    }
}
