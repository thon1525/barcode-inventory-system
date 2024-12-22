<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\SupplierModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\stockin_product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class stockController extends Controller
{

    public function stock_in()
    {
        $category = DB::table('categories')
        ->select('catid', 'category_name')
        ->get();

        return view('stock.stock_in', compact('category'));

    }
    // search product
    public function searchproducts(Request $rq)
    {
        $product_name = $rq->val_show_item;
        // $array = [$product_name];
        //     $product = DB::table('products')
        //     ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
        //     ->leftJoin('ordered_product', 'products.ordered_product_id', '=', 'ordered_product.id')
        //       ->where('products.product_name',  $product_name)
        //      ->select('products.product_name','categories.category_name','ordered_product.product_price','ordered_product.product_discount','ordered_product.product_qty','ordered_product.product_total','products.product_code',)
        //     ->get();
        //   return $product;
        // add select all
        // $product = DB::table('products')
        // ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
        // ->leftJoin('products', 'ordered_product.product_id', '=', 'products.id')
        //   ->where('ordered_product.product_name',  $product_name)
        //  ->select('ordered_product.product_name','categories.category_name','ordered_product.product_qty','ordered_product.product_price','ordered_product.product_total','ordered_product.product_discount','products.product_code')
        // ->get();
        // return $product;

        $product = DB::table('ordered_product')
            ->leftJoin('products', 'ordered_product.product_id', '=', 'products.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
            ->where('ordered_product.product_name',  $product_name)
            ->select('ordered_product.product_name', 'categories.category_name', 'ordered_product.product_qty', 'ordered_product.product_price', 'ordered_product.product_total', 'ordered_product.product_discount', 'products.product_code')
            ->get();
        return $product;
        //    if($product_name and isset($product)){
        //         $product_all = DB::table('products')
        //         ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
        //          ->select('products.product_name','categories.category_name','products.product_qty','products.product_qty','products.product_code')
        //         ->get();
        //         // print_r( $product);
        //            return $product_all;
        //     }

        //echo $product_name;

    }
    // create function in stock
    public function stock_in_product(Request $req)
    {
        $approduct = $req->approduct;
        $select_option = $req->select_option;
        $form_date_values = $req->form_date_values;
        $qty_product = $req->qty_product;
        $price_product = $req->price_product;
        $totalvalues_product = $req->totalvalues_product;
        $barcode_product = $req->barcode_product;
        $discount_product = $req->discount_product;
        // insert db in laravel
        stockin_product::select('date_stock_in', 'name_product_stockin', 'categore_stockin_pro', 'qty_product_stockin', 'price_product_stockin', 'total_product_stockin', 'product_barcode_stockin', 'discount_pro_stock')
            ->insert([
                'date_stock_in' => $form_date_values,
                'name_product_stockin' => $approduct,
                'categore_stockin_pro' => $select_option,
                'qty_product_stockin' => $qty_product,
                'price_product_stockin' => $price_product,
                'total_product_stockin' => $totalvalues_product,
                'product_barcode_stockin' => $barcode_product,
                'discount_pro_stock' => $discount_product,
            ]);
        echo 1;
    }
    public function stock_in_productpos(Request $rq)
    {
        $form_date_values = $rq->form_date_values;
        $form_select_product = $rq->form_select_product;
        $select_option_category = $rq->select_option_category;
        $qty_product = $rq->qty_product;
        $price_product = $rq->price_product;
        $product_totalqty = $rq->product_totalqty;
        $barcodeproduct = $rq->barcodeproduct;
        $discount_product = $rq->discount_product;

        // insert product now
        stockin_product::select('date_stock_in', 'name_product_stockin', 'categore_stockin_pro', 'qty_product_stockin', 'price_product_stockin', 'total_product_stockin', 'product_barcode_stockin', 'discount_pro_stock')
            ->insert([
                'date_stock_in' => $form_date_values,
                'name_product_stockin' => $form_select_product,
                'categore_stockin_pro' => $select_option_category,
                'qty_product_stockin' => $qty_product,
                'price_product_stockin' => $price_product,
                'total_product_stockin' => $product_totalqty,
                'product_barcode_stockin' => $barcodeproduct,
                'discount_pro_stock' => $discount_product,
            ]);
        echo 1;
    }
    // list product
    public function list_stock_in()
    {
        $select_stockin = DB::table('stock_in')
        ->join('products', 'stock_in.ProductID', '=', 'products.id') // Assuming ProductID is the foreign key
        ->select(
            'stock_in.StockInID',
            'stock_in.DateIn',
            'products.product_name as name_product_stockin',
            'products.product_price as price_product_stockin',
            'products.category_id as category_id_stockin',
            'products.product_code as product_code_stockin',
            'stock_in.Quantity as qty_product_stockin',
            'stock_in.UnitCost as unit_cost_stockin',
            DB::raw('stock_in.Quantity * stock_in.UnitCost as total_product_stockin'),
            'products.product_img as product_img_stockin',
            'stock_in.Supplier_id as supplier_id_stockin',
            'products.date_expire as date_expire_stockin'
        )
        ->get();
        return view("stock.manage_stock_in", compact('select_stockin'));
    }
    // remove function
    public function order_product(Request $rq)
    {
        $form_select_product = $rq->form_select_product;
        DB::table('ordered_product')->select('product_name')
            ->where('product_name', $form_select_product)
            ->delete();
    }





    public function showAddStockForm($id)
    {
        // Fetch product details by ID
        $product = DB::table('products')->where('id', $id)->first();

        return view('stock.add', compact('product'));
    }
    // Method to handle stock addition
   // Method to handle stock addition
   public function addStock(Request $request, $id)
   {
       $request->validate([
           'quantity' => 'required|integer|min:1',
       ]);

       $quantity = $request->input('quantity');

       // Update the stock in the database
       DB::table('products')
           ->where('id', $id)
           ->increment('stock', $quantity);

       // Record the stock movement
       DB::table('stock_movements')->insert([
           'product_id' => $id,
           'type' => 'in',
           'quantity' => $quantity,
           'created_at' => now(),
           'updated_at' => now(),
       ]);

       return redirect()->route('stock.index')->with('success', 'Stock added successfully');
   }
}
