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
        'date'
    ];

    public $translatable = ['title', 'description', 'short_description'];

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }
}
