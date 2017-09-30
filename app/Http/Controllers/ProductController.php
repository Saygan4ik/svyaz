<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\ProductRequest;
use App\Repositories\GroupRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    protected $productRepository;
    protected $groupRepository;

    public function __construct(ProductRepository $productRepository, GroupRepository $groupRepository) {
        $this->productRepository = $productRepository;
        $this->groupRepository = $groupRepository;
        $this->middleware('admin')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route = Route::current();
        $group = $route->group;
        if($group)
            $products = $this->productRepository->getProductsOrderBy($this->groupRepository->getIdByName($group)->id);
        else
            $products = $this->productRepository->getProductsOrderBy();
        $groups = $this->groupRepository->all();
        return view('admin/product', compact('products', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = $this->groupRepository->all(['id', 'nameRU'])->pluck('nameRU', 'id');
        return view('product/create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productRepository->store($request->all());
        return redirect('/product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->getById($id);
        $comments = $this->commentRepository->getAllCommentsByProductId($id);
        return view('product/show', compact('product', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->getById($id);
        $group = $this->groupRepository->all(['id', 'nameRU'])->pluck('nameRU', 'id');
        return view('product/edit', compact('product', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->productRepository->update($id, $request->all());
        return redirect('product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return back();
    }
}
