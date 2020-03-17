<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Phrases;
use App\Models\Word;
use App\Models\Lesson;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    
    public function index()
    {
        $lessons = Lesson::orderBy('id', 'asc')->take(5)->get();
        $phrases = Phrases::orderBy('english', 'asc')->get();
        $words = Word::orderBy('english', 'asc')->get();
        return view('frontend.home', compact('phrases', 'words', 'lessons'));
    }

    public function profile()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function update_profile(Request $request) 
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        $user->name = $request->get('name');
        if($request->get('new_password') && $request->get('new_password') == $request->get('confirm_password')) {
            $user->password = Hash::make($request->get('new_password'));
        }

        $user->save();

        Session::flash('success', 'User saved successfully!');

        return redirect('/profile');
    }

    public function guide() {
        return view('frontend.guide');
    }
}
