<?php

namespace App\Factories;

class CategoryFactory
{
    /**
     * Format category
     *
     * @param array $item
     *
     * @return array
     */
    public function makeArray($item): array
    {
        $categoriesArray = [
            'id' => $item['id'],
            'title' => $item['description']['title'] ?? null,
            'description' => $item['description']['description'] ?? null,
            'seo_h1' => $item['description']['seo_h1'] ?? null,
            'meta_title' => $item['description']['meta_title'] ?? null,
            'meta_description' => $item['description']['meta_description'] ?? null,
            'meta_keyword' => $item['description']['meta_keyword'] ?? null,
            'slug' => $item['slug'],
            'image' => $item['image'] ?? null,
        ];

        if (isset($item['related'])) {
            foreach ($item['related'] as $related) {
                $categoriesArray['related'][] = [
                    'title' => $related['description']['title'],
                    'slug' => $related['slug']
                ];
            }
        }

        return $categoriesArray;
    }

    /**
     * Format menu categories
     *
     * @param array $categories
     *
     * @return array
     */
    public function makeArrayMenu($categories): array
    {
        $categoriesArray = [];
        foreach ($categories as $key => $item) {
            $categoriesArray[$key] = [
                'id' => $item['id'],
                'title' => $item['description']['title'] ?? null,
                'slug' => $item['slug']
            ];

            if ($item['children']) {
                $categoriesArray[$key]['children'] = $this->recursiveMakeArrayMenu($item['children']);
            }
        }
        return $categoriesArray;
    }

    /**
     * Format menu recursive categories
     *
     * @param array $categories
     *
     * @return array
     */
    public function recursiveMakeArrayMenu($categories): array
    {
        $categoriesArray = [];
        foreach ($categories as $key => $item) {
            $categoriesArray[$key] = [
                'id' => $item['id'],
                'title' => $item['description']['title'] ?? null,
                'slug' => $item['slug']
            ];

            if ($item['children']) {
                $categoriesArray[$key]['children'] = $this->recursiveMakeArrayMenu($item['children']);
            }
        }
        return $categoriesArray;
    }
}
