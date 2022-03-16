<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryRepository, $productRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, ProductRepositoryInterface $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function getCategory($id)
    {
        $categories = $this->categoryRepository->getCategories($id);
        $products = $this->productRepository->getProducts($id);

        dd($categories, $products);     
        return view('pages.category', [
            'category' => $category,
        ]);
    }
}
