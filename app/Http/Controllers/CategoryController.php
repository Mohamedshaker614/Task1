<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $categoryService;


    public function __construct()
    {
        $this->categoryService = new CategoryService();

        $this->middleware('permission:Categories,admins')->only('index');
        $this->middleware('permission:Category Add,admins')->only(['store']);
        $this->middleware('permission:Category List Edit,admins')->only(['update']);
        $this->middleware('permission:Category List delete,admins')->only(['destroy']);
    }


    public function index(Request $request)
    {
        return $this->categoryService->handleCategoriesList($request);
    }

    public function store(Request $request)
    {
        $this->categoryService->store($request);
        return redirect()->route('categories.index');
    }

    public function updateCategory(Request $request, $id)
    {
        return $this->categoryService->update($request, $id);
    }

    public function destroy($id)
    {
        $this->categoryService->getById($id)->delete();
        return response()->json(['success' => 'Deleted Success', 'id' => $id]);
    }
}
