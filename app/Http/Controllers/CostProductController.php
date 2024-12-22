<?php

namespace App\Http\Controllers;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CostProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = DB::table('categories')
            ->select('catid', 'category_name')
            ->get();
        // $product= DB:table('products')
        // ->

        return view('costProduct.product_with_tax', compact('category'));
    }

    public function selectProduCtcatgory(Request $request)
    {
        $categoryId = $request->input('category');
        $products = DB::table('products')
        ->select(
            'products.product_name',
            'products.product_price',
            'products.id',
            'products.category_id',

        )
        ->where('products.category_id',  $categoryId )
        ->get();

        return response()->json($products);
    }

    public function selectProduct(Request $request)
    {
        $productId = $request->input('product_id');
        $product = ProductModel::find($productId);
        return response()->json([
            'product_name' => $product->product_name,
            'product_price' => $product->product_price,

        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
