<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    protected $fillable = [
        'writer_id',
        'image',
        'video',
        'title',
        'description',
        'short_description',
        'date',
        'is_approved',
        'action_type',
        'approved_at'
    ];

    public $translatable = ['title', 'description', 'short_description'];

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }
   
public function likes()
{
    return $this->hasMany(PostLike::class);
}

public function comments()
{
    return $this->hasMany(PostComment::class)->latest();
}

public function likesCount()
{
    return $this->likes()->count();
}
public function user()
{
    return $this->belongsTo(User::class);
}

public function replies()
{
    return $this->hasMany(PostComment::class, 'parent_id');
}

public function parent()
{
    return $this->belongsTo(PostComment::class, 'parent_id');
}
}
