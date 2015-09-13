<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Flash;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = $this->productRepository->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('admin.product.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        if ($this->productRepository->create($request)){
            Flash::success('Successfully stored');
        } else {
            Flash::error('Save error');
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->byId($id);
        if (! $product){
            abort(404);
        }

        return view('admin.product.show',  compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->byId($id);
        if (! $product){
            abort(404);
        }

        $categories = $this->categoryRepository->all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = $this->productRepository->byId($id);
        if (! $product){
            abort(404);
        }

        if ($this->productRepository->update($product, $request)){
            Flash::success('Successfully updated');
        } else {
            Flash::error('Save error');
        }

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->byId($id);
        if (! $product){
            abort(404);
        }

        if ($this->productRepository->delete($product)){
            Flash::success('Successfully updated');
        } else {
            Flash::error('Delete error');
        }

        return redirect()->route('admin.product.index');
    }
}
