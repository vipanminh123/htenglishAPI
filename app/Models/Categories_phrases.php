<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories_phrases extends Model
{
    protected $fillable = ['name', 'alias', 'description'];

    public function Phrases() {
    	return $this->hasMany('App\Models\Phrases', 'cat_phrase_id');
    }
}
