<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Writer extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'bio', 'image', 'subsection_id'];
    public $translatable = ['name', 'bio'];

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
