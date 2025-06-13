<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Writer extends Model
{
    use HasTranslations;
    use Notifiable;
    protected $fillable = ['name','user_id', 'bio', 'image', 'subsection_id'];
    public $translatable = ['bio'];

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
