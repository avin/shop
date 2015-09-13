<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Product\IndexRequest;
use App\Http\Requests\Front\Product\StoreReviewRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Auth;
use Flash;

class ProductController extends Controller {

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


    public function index(IndexRequest $request){
        $products = $this->productRepository->get($request->all(), 9);

        return view('front.product.index', compact('products'));
    }

    public function show($id){
        $product = $this->productRepository->byId($id);
        if (! $product){
            abort(404);
        }

        return view('front.product.show', compact('product', 'authors'));
    }

    public function storeReview(StoreReviewRequest $request, $id){
        $product = $this->productRepository->byId($id);
        if (! $product){
            abort(404);
        }

        $reviewData = [
            'content' => $request['content'],
            'author' => Auth::user()->_id,
        ];

        if ($this->productRepository->createReview($product, $reviewData)){
            Flash::message('Review created');
        } else {
            Flash::error('Save review failed');
        }

        return redirect()->back()->withInput();
    }

    public function getRandom(){
        //TODO
    }

    public function buy($id){

        Flash::message('Product added to your cart');
        return redirect()->back();
    }
}