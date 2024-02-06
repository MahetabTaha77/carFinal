<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $Categories = Category::where('active', 1)->get();
        return view('admin.category.list', compact('Categories'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'unique:categories'],
        ]);

        $Category = new Category();
        $Category->name = $request->name;
        $Category->save();

        return redirect()->route('admin.category.list');
    }

    public function edit(Category $Category)
    {
        return view('admin.category.edit', compact('Category'));
    }

    public function update(Request $request, Category $Category)
    {
        $request->validate([
            'name'  => ['required'],
        ]);

        $Check = Category::where('id', '<>', $Category->id)
            ->where('name', $request->name)->first();

        if ($Check) {
            return redirect()->back()->withErrors('Category Already Exist');
        }

        $Category->name = $request->name;
        $Category->save();

        return redirect()->route('admin.category.list');
    }

    public function active(Category $Category)
    {
        $Category->active = !$Category->active;
        $Category->save();

        return redirect()->route('admin.category.list');
    }
}
