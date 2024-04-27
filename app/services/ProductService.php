<?php

namespace App\services;

use App\Helpers\CommonHelper;
use App\Models\Category;
use App\Models\Product;
use App\Utility\Guard;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ProductService
{

    protected  $upload_distination = '/uploads/images/products/';

    public function handleProductList(Request $request)  {
        $categories = Category::all();

        $data= Product::query();

        if(\request()->ajax()){
            return DataTables::eloquent($data)
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('name')) ) {
                    $instance->where('name',  'like', '%' . $request->get('name') . '%');
                }
                if (!empty($request->get('brand')) ) {
                    $instance->where('brand',  'like', '%' . $request->get('brand') . '%');
                }
                if (!empty($request->get('to')) ) {
                    $instance->where('price', '<=', $request->get('to'));
                }
                if (!empty($request->get('from')) ) {
                    $instance->where('price', '>=', $request->get('from'));
                }

            })
            ->addColumn('name', function($row){
                return $row->name;
            })
            ->addColumn('category', function($row){
                return $row->category->name;
            })
            ->addColumn('image', function($row){
                $imagePath = '<img style="width:200px;" src="'.$row->image_url.'">';

                return $imagePath;
            })
            ->addColumn('action', function($row)use(  $categories){

                $modalView=view('dashboard.products.editModal',['product'=>$row,'categories'=>$categories])->render();
                $actionBtn = '
                <div class="row">
                <div class="col-sm-6">';
                if (Auth::guard(Guard::ADMINS)->user()->can('Category Edit')) {
                    $actionBtn = '
                    <button class="btn btn-primary btn-block openModal"
                        data-toggle="modal" data-target="#edit-'.$row->id.'">Edit <i
                            class="ri-edit-fill"></i> </button>
                </div>';
                }
                if (Auth::guard(Guard::ADMINS)->user()->can('Category Edit')) {
                    $actionBtn = '
                <div class="col-sm-6">
                    <button class="btn btn-danger btn-block delete"
                        data-route="'.url("products/$row->id").'">Delete <i
                            class="ri-delete-fill"></i> </button>
                </div>';
                }
                    $actionBtn = '
            </div>
                ';

                return $actionBtn . $modalView ;
            })
            ->rawColumns(['action','category','image'])
            ->make(true);
        }

        return view('dashboard.products.index', compact('data', 'categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'brand' => 'nullable|string',
            'image' => 'nullable|sometimes|mimes:jpg,png',
            'details' => 'nullable|string',
            'category_id' => 'sometimes|nullable',
        ]);
        if (isset($validated['image'])) {
            $image_name = CommonHelper::quickRandom();
            $image_name = $image_name . '.' . $request->file('image')->getClientOriginalExtension(); // add the extention
            $path = $request->file('image')->storeAs($this->upload_distination, $image_name, 'shaker');
            $validated['image'] = $image_name;
        }
        $product = Product::create($validated);
        $respond['product'] = $product;
        return view('dashboard.products.ajax.row')->with($respond);
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'brand' => 'nullable|string',
            'image' => 'nullable|sometimes|mimes:jpg,png',
            'details' => 'nullable|string',
            'category_id' => 'sometimes|nullable',
        ]);
        if (isset($validated['image'])) {
            $image_name = CommonHelper::quickRandom();
            $image_name = $image_name . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs($this->upload_distination, $image_name, 'shaker');
            $validated['image'] = $image_name;
        }
        $product = $this->getById($id);
        $product = $product->update($validated);
        $product = $this->getById($id);
        $respond['product'] = $product;
        return view('dashboard.products.ajax.rowEdit')->with($respond);
    }


}
