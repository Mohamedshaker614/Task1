<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productSevice;
    public function __construct()
    {
        $this->productSevice = new ProductService();

        $this->middleware('permission:Products,admins')->only('index');
        $this->middleware('permission:Product Add,admins')->only(['store']);
        $this->middleware('permission:Product List Edit,admins')->only(['update']);
        $this->middleware('permission:Product List delete,admins')->only(['destroy']);
    }


    public function index(Request $request)
    {
        return $this->productSevice->handleProductList($request);
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        return $this->productSevice->store($request);
    }

    public function updateProduct(Request $request, $id)
    {
        return $this->productSevice->update($request, $id);
    }

    public function destroy($id)
    {
        $this->productSevice->getById($id)->delete();
        return response()->json(['success' => 'Deleted Success', 'id' => $id]);
    }
}
