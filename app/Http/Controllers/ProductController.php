<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Product;
use App\ProductCategory;

use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        $title = "Product List";

        $items = Product::with([
            'category'
        ])->get();

        return view('pages.product.index', [
            'title' => $title,
            'items' => $items
        ]);
    }
    public function create()
    {
        $title = "Create new product";

        $categories = ProductCategory::all();

        return view('pages.product.create', [
            'title' => $title,
            'categories' => $categories
        ]);
    }
    public function store(ProductRequest $request)
    {
        $photo = $request->file('photo');

        $data = $request->all();
        
        if ($photo){
            $data['photo'] = $photo->store(
                'assets/product', 'public'
            );
        }else{
            $data['photo'] = "";
        }

        $data['purchase_price'] = str_replace(',', '', $data['purchase_price']);
        $data['selling_price'] = str_replace(',', '', $data['selling_price']);

        Product::create($data);

        return redirect()->route('product.index')->with('success','Produk berhasil ditambahkan!');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $title = "Edit Product";

        $item = Product::findOrFail($id);
        $categories = ProductCategory::all();

        return view('pages.product.edit', [
            'title' => $title,
            'item' => $item,
            'categories' => $categories
        ]);
    }
    public function update(ProductRequest $request, $id)
    {
        $photo = $request->file('photo');

        $data = $request->all();
        $data['purchase_price'] = str_replace(',', '', $data['purchase_price']);
        $data['selling_price'] = str_replace(',', '', $data['selling_price']);
        
        if ($photo){
            $data['photo'] = $photo->store(
                'assets/product', 'public'
            );
        }

        Product::findOrFail($id)->update($data);

        return redirect()->route('product.index')->with('success','Produk berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('product.index')->with('success','Produk berhasil dihapus!');
    }
}
