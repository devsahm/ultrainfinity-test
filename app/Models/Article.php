<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'body'];

    protected $with = ['comments', 'tags'];

    public function comments() : HasMany
    {
       return $this->hasMany(Comment::class);
    }


    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

}
