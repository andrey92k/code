<?php

namespace App\Models;

use App\Helpers\YesNo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;

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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', YesNo::YES);
        });
    }

    public function description()
    {
        return $this->hasOne(ProductDescription::class, 'product_id')->where('language_id', app('language_id'));
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'product_related', 'product_id', 'related_id');
    }

    public function featured()
    {
        return $this->belongsToMany(Product::class, 'product_featured', 'product_id', 'featured_id');
    }

    public function reviews()
    {
        return $this->belongsToMany(Review::class, 'product_review', 'product_id', 'review_id');
    }
}
