<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Review extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'author_name',
        'author_email',
        'rating',
        'content',
        'dignity',
        'limitations',
        'answer_id',
        'user_id',
        'is_deal_confirmed'
    ];

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'review_id', 'user_id');
    }
}
