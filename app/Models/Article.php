<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Bus\Queueable;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($article) {
            $article->comments()->delete();
        });
}}
