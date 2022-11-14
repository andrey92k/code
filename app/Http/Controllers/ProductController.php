<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(private ProductRepositoryInterface $productRepository)
    {
    }

    /**
     * Get products
     *
     * @param int $id
     *
     */
    public function getProducts(int $id)
    {
        $products = $this->productRepository->getProducts($id);
        dd($products);
    }

    /**
     * Get product
     *
     * @param int $id
     *
     */
    public function getProduct(int $id)
    {
        $product = $this->productRepository->find($id);
        dd($product);
    }
}
