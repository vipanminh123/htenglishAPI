<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['title', 'character1', 'character2', 'english', 'vietnamese', 'alias', 'audio', 'level', 'order'];
}
