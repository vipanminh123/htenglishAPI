<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['english', 'vietnamese', 'alias', 'audio'];

    public function users() {
        return $this->belongsToMany('App\User', 'user_word', 'user_id', 'word_id');
    }
}
