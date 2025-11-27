<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // required for getExcerpt()

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function getExcerpt()
    {
        return Str::limit($this->content, 100);
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];
}
