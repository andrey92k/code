<?php

namespace App\Models;

use App\Helpers\YesNo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    public $fillable = [
        'slug',
        'parent_id',
        'order',
        'status'
    ];

    protected $with = ['children'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', YesNo::YES);
        });
    }

    public function description()
    {
        return $this->hasOne(CategoryDescription::class, 'category_id')->where('language_id', app('language_id'));
    }

    public function descriptions()
    {
        return $this->hasMany(CategoryDescription::class, 'category_id');
    }

    public function related()
    {
        return $this->belongsToMany(Category::class, 'category_related', 'category_id', 'related_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    //children recursive

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order', 'ASC');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parent')->orderBy('order', 'ASC');
    }

    //recursive Categories

    private $descendants = [];

    public function recursiveChildren()
    {
        return $this->children()->with('recursiveChildren');
    }

    public function hasChildren()
    {
        if ($this->recursiveChildren->count()) {
            return true;
        }

        return false;
    }
    public function findDescendants(Category $category)
    {
        $this->descendants[] = $category->id;

        if ($category->hasChildren()) {
            foreach ($category->recursiveChildren as $child) {
                $this->findDescendants($child);
            }
        }
    }

    public function getDescendants(Category $category)
    {
        $this->findDescendants($category);
        return $this->descendants;
    }
}
