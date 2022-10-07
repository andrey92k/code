<?php

namespace App\Models;

use App\Helpers\YesNo;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Category extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'slug',
        'parent_id',
        'order',
        'status'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['children'];

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
        return $this->hasOne(CategoryDescription::class, 'category_id')->where('language_id', app('language_id'));
    }

    /**
     * @return HasMany
     */
    public function descriptions(): HasMany
    {
        return $this->hasMany(CategoryDescription::class, 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function related(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_related', 'category_id', 'related_id');
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * children recursive
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order', 'ASC');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('parent')->orderBy('order', 'ASC');
    }
    /**
     * Tree categories.
     *
     * @var array
     */
    private $descendants = [];

    /**
     * recursive Categories
     * @return array
     */
    public function recursiveChildren(): array
    {
        return $this->children()->with('recursiveChildren');
    }

    /**
     * Has Children
     *
     * @return bool
     */
    public function hasChildren(): bool
    {
        if ($this->recursiveChildren->count()) {
            return true;
        }

        return false;
    }

    /**
     * search descendants
     */
    public function findDescendants(Category $category)
    {
        $this->descendants[] = $category->id;

        if ($category->hasChildren()) {
            foreach ($category->recursiveChildren as $child) {
                $this->findDescendants($child);
            }
        }
    }

    /**
     * @return array
     */
    public function getDescendants(Category $category): array
    {
        $this->findDescendants($category);
        return $this->descendants;
    }
}
