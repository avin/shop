<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Flash;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    function __construct(
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.category.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        if ($this->categoryRepository->create($request->all())){
            Flash::success('Successfully stored');
        } else {
            Flash::error('Save error');
        }

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->byId($id);
        if (! $category){
            abort(404);
        }

        return view('admin.category.show',  compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->byId($id);
        if (! $category){
            abort(404);
        }

        return view('admin.category.edit', compact('category'));
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
        $category = $this->categoryRepository->byId($id);
        if (! $category){
            abort(404);
        }

        if ($this->categoryRepository->update($category, $request->all())){
            Flash::success('Successfully updated');
        } else {
            Flash::error('Save error');
        }

        return redirect()->route('admin.category.index');
    }

    public function delete($id){
        $category = $this->categoryRepository->byId($id);
        if (! $category){
            abort(404);
        }

        return view('admin.category.delete', compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->byId($id);
        if (! $category){
            abort(404);
        }

        if ($this->categoryRepository->delete($category)){
            Flash::success('Successfully deleted');
        } else {
            Flash::error('Delete error');
        }

        return redirect()->route('admin.category.index');
    }
}
