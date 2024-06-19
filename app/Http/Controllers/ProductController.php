<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::OrderBy('created_at', 'desc')->get();
        return view('product.productList', [
            'products' => $product
        ]);
    }

    public function create()
    {
        return view('product.create');
    }


    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric|min:1',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('product.create')->withInput()->withErrors($validator);
        }

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        // here we will update product
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // Image store
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext; // for unique image name

            // save image ot public directory
            $image->move(public_path('upload/product'), $imageName);

            // save image name in db
            $product->image = $imageName;
            $product->save();

        }


        return redirect()->route('products.index')->with('success', 'Product added successfully');

    }

    public function edit($id)
    {
        $product = product::findOrfail($id);
        return view('product.productEdit', [
            'product' => $product
        ]);
    }

    public function update($id, Request $request)
    {
        $product = product::findOrfail($id);
        $rules = array(
            'name' => 'required|min:5',
            'sku' => 'required|min:3',
            'price' => 'required|numeric|min:1',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('product.edit', $product->id)->withInput()->withErrors($validator);
        }

        if ($request->image != "") {
            $rules['image'] = 'image';
        }


        // here we will update product
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != "") {
            // Delete Old image
            File::delete(public_path('upload/product' . $product->image));

            // Image store
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext; // for unique image name

            // save image ot public directory
            $image->move(public_path('upload/product'), $imageName);
            // save image name in db
            $product->image = $imageName;
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Product Updated successfully');
    }


    public function delete($id){
        $product=Product::findOrFail($id);
        // Delete image
        File::delete(public_path('upload/product' . $product->image));

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');


    }




}
