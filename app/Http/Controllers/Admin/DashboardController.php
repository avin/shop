<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;

class DashboardController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;

    function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $productsCount = $this->productRepository->count();
        $categoriesCount = $this->productRepository->count();
        return view('admin.dashboard.index', compact('productsCount', 'categoriesCount'));
    }

}
