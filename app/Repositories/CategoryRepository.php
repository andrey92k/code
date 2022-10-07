<?php

namespace App\Repositories;

use App\Factories\CategoryFactory;
use App\Models\Category as GroupEloquent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends AbstractEloquentRepository implements CategoryRepositoryInterface
{
    protected $eloquent = GroupEloquent::class;

    /**
     * CategoryRepository constructor.
     * @param CategoryFactory $categoyFactory
     */
    public function __construct(private CategoryFactory $categoryFactory)
    {
    }

    /**
     * Get categories without children.
     *
     * @param int $id
     *
     * @return array
     */
    public function getCategories(int $id): array
    {
       $data =  $this->model()->without('children')->with([
           'description',
           'related',
           'relatedProducts',
       ])->findOrFail($id);

       return $this->categoryFactory->makeArray($data);
    }
}
