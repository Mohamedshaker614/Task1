<?php

namespace App\services;

use App\Models\Category;
use App\Utility\Guard;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CategoryService
{


    public function handleCategoriesList(Request $request)
    {
        $data = Category::query();
        if (\request()->ajax()) {
            return DataTables::eloquent($data)
                ->addColumn('action', function ($row) {
                    $modalView = view('dashboard.category.editModal', ['category' => $row])->render();
                    $actionBtn = '
                    <div class="row">';
                    if (Auth::guard(Guard::ADMINS)->user()->can('Category Edit')) {
                        $actionBtn = '
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-block openModal"
                        data-toggle="modal" data-target="#edit-' . $row->id . '">Edit <i
                            class="ri-edit-fill"></i> </button>
                            </div>';
                    }
                    if (Auth::guard(Guard::ADMINS)->user()->can('Category Delete')) {
                        $actionBtn = '
                <div class="col-sm-6">
                    <button class="btn btn-danger btn-block delete"
                        data-route="' . url("categories/$row->id") . '">Delete <i
                            class="ri-delete-fill"></i> </button>
                </div>';
                    }
                    $actionBtn = '
            </div>
                ';

                    return $actionBtn . $modalView;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.category.index', compact('data'));
    }

    public function getById($id)
    {
        return Category::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:225',
            'details' => 'string|nullable',
        ]);
        return Category::create($validated);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:225',
            'details' => 'string|nullable',
        ]);
        $category = Category::findOrFail($id);
        return $category->update($validated);
    }
}
