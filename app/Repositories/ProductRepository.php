<?php

namespace App\Repositories;

use App\Factories\ProductFactory;
use App\Helpers\YesNo;
use App\Models\Product as GroupEloquent;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends AbstractEloquentRepository implements ProductRepositoryInterface
{
    protected $eloquent = GroupEloquent::class;
    /**
     * @var ProductFactory
     */
    private $productFactory;

    /**
     * CategoryRepository constructor.
     * @param ProductFactory $productFactory
     */
    public function __construct(ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    public function getProducts($id)
    {
        $data = $this->model()->where('category_id', $id)->with([
            'description',
            'related',
            'featured',
            'reviews'
        ])->paginate(10);

        return $data->setCollection(collect($this->productFactory->makeArrays($data)));
    }

    public function find(int $id)
    {
       $data =  $this->model()->findOrFail($id);

       return $this->productFactory->makeArray($data);
    }
}
