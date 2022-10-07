<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductDescription extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'product_id',
        'language_id',
        'title',
        'description',
        'seo_h1',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'tag'
    ];
}
