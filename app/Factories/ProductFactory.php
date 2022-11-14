<?php

namespace App\Factories;

class ProductFactory
{

    /**
     * Format product
     *
     * @param array $item
     *
     * @return array
     */
    public function makeArray($item): array
    {
        return $item->toArray();
    }

    /**
     * Format products
     *
     * @param array $item
     *
     * @return array
     */
    public function makeArrays($items): array
    {

        $productsArray = [];
        foreach ($items as $key => $item) {

            $productsArray[$key] = [
                'id' => $item['id'],
                'title' => $item['description']['title'] ?? null,
                'slug' => $item['slug'],
                'rating' => $item->reviews->avg('rating'),
                'sku' => $item['sku'],
                'model' => $item['model'],
                'sale_price' => $item['sale_price'],
                'price' => $item['price'],
                'cashback' => $item['cashback']
            ];
        }

        return $productsArray;
    }
}
