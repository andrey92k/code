<?php

namespace App\Repositories;

use App\Factories\CategoryFactory;
use App\Helpers\YesNo;
use App\Models\Category as GroupEloquent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Cache;

//use App\Entities\Group;

class CategoryRepository extends AbstractEloquentRepository implements CategoryRepositoryInterface
{
    protected $eloquent = GroupEloquent::class;
    /**
     * @var CategoyFactory
     */
    private $categoryFactory;

    /**
     * CategoryRepository constructor.
     * @param CategoryFactory $categoyFactory
     */
    public function __construct(CategoryFactory $categoryFactory)
    {
        $this->categoryFactory = $categoryFactory;
    }

    public function getCategories(int $id)
    {
       $data =  $this->model()->without('children')->with(
           'description',
           'related',
           'relatedProducts',
       )->findOrFail($id);

       return $this->categoryFactory->makeArray($data);
    }
}
