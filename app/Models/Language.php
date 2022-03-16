<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Language extends Model
{
    use Notifiable;

    public $fillable = [
        'title',
        'code',
        'locale',
        'status'
    ];

}
