<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts($id)
    {
        $products = $this->productRepository->getProducts($id);
    }

    public function getProduct($id)
    {
        $product = $this->productRepository->find($id);
        dd($product);
        return view('pages.category', [
            'product' => $product,
        ]);
    }
}
