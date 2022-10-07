<?php

namespace App\Models;

use App\Helpers\YesNo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'slug',
        'sku',
        'model',
        'manufacturer_id',
        'markdown',
        'sale_price',
        'price',
        'cashback',
        'type_product',
        'order',
        'status'
    ];

    /**
     * Boot events.
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', YesNo::YES);
        });
    }

    /**
     * @return HasOne
     */
    public function description(): HasOne
    {
        return $this->hasOne(ProductDescription::class, 'product_id')->where('language_id', app('language_id'));
    }

    /**
     * @return BelongsToMany
     */
    public function related(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_related', 'product_id', 'related_id');
    }

    /**
     * @return BelongsToMany
     */
    public function featured(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_featured', 'product_id', 'featured_id');
    }

    /**
     * @return BelongsToMany
     */
    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Review::class, 'product_review', 'product_id', 'review_id');
    }
}
