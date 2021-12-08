<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $categories = Category::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })
            ->latest()
            ->paginate(10);


        return view('dashboard.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = RuleFactory::make([
            '%name%' => ['required', 'string', 'max:255', 'unique:category_translations,name'],
        ]);

        $request->validate($rules);

        Category::create($request->except('_token', '_method'));

        $request->session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //

        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $rules = RuleFactory::make([
            '%name%' => ['required', 'string', 'max:255', 'unique:category_translations,name'],
        ]);

        $request->validate($rules);

        $category->update($request->except('_token', '_method'));

        $request->session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //

        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    }
}
