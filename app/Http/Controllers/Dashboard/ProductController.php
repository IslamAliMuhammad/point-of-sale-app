<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Astrotomic\Translatable\Validation\RuleFactory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::when($request->search, function ($query) use ($request) {

            return $query->whereTranslationLike('name', '%' . $request->search . '%');

        })->when($request->category_id, function ($query) use ($request) {

            return $query->where('category_id', $request->category_id);

        })
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('dashboard.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('dashboard.products.create', compact('categories'));
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
            'category_id' => 'required|exists:categories,id',
            '%name%' => ['required', 'string', 'max:255', Rule::unique('category_translations', 'name')],
            '%description%' => ['required', 'string', 'max:4096'],
            'image' => 'file',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $request->validate($rules);

        $requestData = $request->except(['_token', '_method', 'image']);

        // Image
        if($request->image) {
            // compress and store image
            $hashImageName = $request->image->hashName();

            Image::make($request->image)->fit(320 , 320, function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/product-images/') . $request->image->hashName());

            $requestData['image'] = $hashImageName;
        }else {
            $requestData['image'] = 'default.png';
        }

        Product::create($requestData);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $rules = RuleFactory::make([
            'category_id' => 'required|exists:categories,id',
            '%name%' => ['required', 'string', 'max:255', Rule::unique('product_translations', 'name')->ignore($product->id, 'product_id')],
            '%description%' => ['required', 'string', 'max:4096'],
            'image' => 'file',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $request->validate($rules);

        $requestData = $request->except(['_token', '_method', 'image']);

        // Image
        if($request->image) {
            // delete old product image except if it was default.png
            if($product->image !== 'default.png') {
                Storage::disk('public_uploads')->delete('product-images/' . $product->image);
            }

            // compress and store image
            $hashImageName = $request->image->hashName();

            Image::make($request->image)->fit(320 , 320, function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/product-images/') . $request->image->hashName());

            $requestData['image'] = $hashImageName;
        }

        $product->update($requestData);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        // delete product image
        if($product->image !== 'default.png'){
            Storage::disk('public_uploads')->delete('product-images/' . $product->image);
        }

        $product->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.products.index');

    }
}
