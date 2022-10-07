<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * ProductController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private ProductRepositoryInterface $productRepository
    ){
    }

    public function getCategory(int $id)
    {
        $categories = $this->categoryRepository->getCategories($id);
        $products = $this->productRepository->getProducts($id);

        dd($categories, $products);
    }
}
