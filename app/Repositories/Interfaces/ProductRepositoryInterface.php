<?php

namespace App\Repositories\Interfaces;

//use App\Entities\Group;

interface ProductRepositoryInterface
{
    public function getProducts(int $id);

//    public function all() : array;

//    public function create($item);
//
//    public function update($item);

    public function delete(int $id);
}
