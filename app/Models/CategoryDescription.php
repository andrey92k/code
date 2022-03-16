<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CategoryDescription extends Model
{
    use Notifiable;

    public $timestamps = false;

    public $fillable = [
        'category_id',
        'language_id',
        'title',
        'description',
        'seo_h1',
        'meta_title',
        'meta_description',
        'meta_keyword'
    ];
}
