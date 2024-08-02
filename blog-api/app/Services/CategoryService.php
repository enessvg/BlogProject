<?php

namespace App\Services;

use App\CommonInterface;
use App\Exceptions\NotFoundMessage;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Cache;

class CategoryService implements CommonInterface {

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function getBySlug($slug)
    {
        return $this->categoryRepository->getBySlug($slug);
    }


}
