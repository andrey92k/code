<?php

namespace App\Repositories\Interfaces;

//use App\Entities\Group;

interface CategoryRepositoryInterface
{
    public function getCategories(int $id);
    public function delete(int $id);
}
