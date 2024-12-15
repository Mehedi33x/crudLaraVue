<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\FileService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $fileService;
    public function __construct(ProductService $productService, FileService $fileService)
    {
        $this->productService = $productService;
        $this->fileService = $fileService;
    }
    public function index()
    {
        $products = Product::select('id','name','price','image')->get();
        return response()->json($products);
    }
    public function store(Request $request)
    {
        $this->doValidation($request);
        $filename = $request->hasFile('image')
        ? $this->fileService->storeFile($request->file('image'), 'products')
        : null;
        $data=$request->all();
        $data['image'] = $filename;
        $product = $this->productService->store(new Product(), $data);
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ], 201);
    }

    public function show($id){
        // dd($id);
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->doValidation($request, $id);
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $filename = $request->hasFile('image')
            ? $this->fileService->updateFile($request->file('image'), 'images', $product->image)
            : $product->image;

            $data=$request->all();
            $data['image'] = $filename;
        $product = $this->productService->update(new Product(), $data);
        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $data,
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        if ($product->image) {
            $this->fileService->deleteFile('images/' . $product->image);
        }
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }

    private function doValidation(Request $request)
    {
        // dd($request->all());
        return $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            // 'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048|string',

        ]);
    }

}
