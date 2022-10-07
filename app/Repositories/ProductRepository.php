<?php

namespace App\Repositories;

use App\Factories\ProductFactory;
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

    /**
     * Get products
     *
     * @param int $id
     *
     * @return array
     */
    public function getProducts(int $id): array
    {
        $data = $this->model()->where('category_id', $id)->with([
            'description',
            'related',
            'featured',
            'reviews',
        ])->paginate(10);

        return $data->setCollection(collect($this->productFactory->makeArrays($data)));
    }

    /**
     * Get product
     *
     * @param int $id
     *
     * @return array
     */
    public function find(int $id): array
    {
       $data =  $this->model()->findOrFail($id);

       return $this->productFactory->makeArray($data);
    }
}
