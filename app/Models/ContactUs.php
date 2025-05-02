<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ContactUs extends Model
{
    use HasTranslations;

    protected $fillable = [
        'email',
        'phone',
        'fax',
        'map',
        'address',
    ];

    public $translatable = ['address'];
}
