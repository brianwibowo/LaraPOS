<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductCategory;

use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $title = "Product Categories";

        $items = ProductCategory::all();

        return view('pages.product.category.index', [
            'title' => $title,
            'items' => $items
        ]);
    }
    public function create()
    {
        $title = "Create new product category";

        return view('pages.product.category.create', [
            'title' => $title
        ]);
    }
    public function store(ProductCategoryRequest $request)
    {
        $data = $request->all();

        ProductCategory::create($data);

        return redirect()->route('product-category.index')->with('success','Kategori produk berhasil ditambahkan!');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $title = "Edit Product Category";

        $item = ProductCategory::findOrFail($id);

        return view('pages.product.category.edit', [
            'title' => $title,
            'item' => $item
        ]);
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();

        ProductCategory::findOrFail($id)->update($data);

        return redirect()->route('product-category.index')->with('success','Kategori produk berhasil diperbarui!');
    }
    public function destroy($id)
    {
        ProductCategory::findOrFail($id)->delete();

        return redirect()->route('product-category.index')->with('success','Kategori produk berhasil dihapus!');
    }
}
