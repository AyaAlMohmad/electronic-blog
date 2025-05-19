<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;

    protected $fillable = ['name','image'];
    public $translatable = ['name'];

    public function subsections()
    {
        return $this->hasMany(Subsection::class);
    }
    // في App\Models\Section
public function posts()
{
    return $this->hasManyThrough(
        Post::class,
        Subsection::class,
        'section_id', // Foreign key on subsections table
        'subsection_id', // Foreign key on posts table (عبر Writer)
        'id', // Local key on sections table
        'id' // Local key on subsections table
    );
}
}
