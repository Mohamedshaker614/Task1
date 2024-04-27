<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productSevice;
    public function __construct()
    {
        $this->productSevice = new ProductService();
    }

    public function index(Request $request)
    {
        $products=Product::with('category')->paginate();
        return response()->json(ProductResource::collection($products));
    }

}
