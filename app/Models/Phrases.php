<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phrases extends Model
{
    protected $fillable = ['english', 'vietnamese', 'alias', 'audio_slow', 'audio_normal', 'cat_phrase_id'];

    public function Categories_phrases() {
    	return $this->belongsTo('App\Models\Categories_phrases', 'cat_phrase_id');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'user_phrase', 'user_id', 'phrase_id');
    }
}
