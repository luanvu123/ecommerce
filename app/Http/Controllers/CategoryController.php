<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $categories = Category::with('parentCategory')->paginate(5);
        return view('admin.categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $parentCategories = Category::pluck('name', 'id')->prepend('None', '');
        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => 'nullable',
        ]);

        $category = new Category([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'parent_id' => $request->input('parent_id'),

        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconPath = $icon->store('category_icons', 'public');
            $category->icon = $iconPath;
        }
        $category->user_id = auth()->id();
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category): View
    {
        $parentCategories = Category::pluck('name', 'id')->prepend('None', '');
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Giới hạn định dạng và kích thước của tệp tin
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => 'nullable',
        ]);

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->parent_id = $request->input('parent_id');
        $category->user_id = auth()->id();
        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $iconPath = $icon->store('category_icons', 'public'); // Lưu trữ icon trong thư mục "public/category_icons"
            $category->icon = $iconPath;
        }

        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category): RedirectResponse
    {
        if ($category->icon) {
            Storage::delete($category->icon);
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
