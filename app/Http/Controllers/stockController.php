<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\SupplierModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\stockin_product;
use Illuminate\Http\Request;

class stockController extends Controller
{

    public function stock_in(){
       $collection_stockin = collect(['name', 'age']);
         $categories = CategoryModel::get();
      // $suppliers = SupplierModel::get();
    //  return  $product = ProductModel::select('*')->where('id', $id)->get();
 //$product_category =ProductModel::select('category_id')->get();

//    $product = DB::table('products')
//     ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
//      ->select('products.product_name')
//     ->get();

// add new
        $product = DB::table('ordered_product')
        ->leftJoin('categories', 'ordered_product.category_id', '=', 'categories.catid')
        ->select('ordered_product.product_name')
        ->get();

    // get categories name
     // $product = ProductModel::select('product_name')->where('id', $ProductModel)->get();
      return view('stock.stock_in',compact('product','categories'));


    //  $items = [
    //     (object) ['id' => 1, 'name' => 'Item 1'],
    //     (object) ['id' => 2, 'name' => 'Item 2'],
    //     (object) ['id' => 3, 'name' => 'Item 3'],
    // ];

    // $existingRecordId = 2; // Example value for the existing record ID

    // return view('stock.stock_in', compact('items', 'existingRecordId'));

    }
    // search product
    public function searchproducts(Request $rq){
    $product_name= $rq->val_show_item;
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
     ->select('ordered_product.product_name','categories.category_name','ordered_product.product_qty','ordered_product.product_price','ordered_product.product_total','ordered_product.product_discount','products.product_code')
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
    public function stock_in_product(Request $req){
     $approduct=$req->approduct;
     $select_option=$req->select_option;
     $form_date_values=$req->form_date_values;
     $qty_product=$req->qty_product;
     $price_product=$req->price_product;
     $totalvalues_product=$req->totalvalues_product;
     $barcode_product=$req->barcode_product;
     $discount_product=$req->discount_product;
      // insert db in laravel
      stockin_product::select('date_stock_in','name_product_stockin','categore_stockin_pro','qty_product_stockin','price_product_stockin','total_product_stockin','product_barcode_stockin','discount_pro_stock')
                   ->insert([
                    'date_stock_in'=>$form_date_values,
                    'name_product_stockin'=>$approduct,
                    'categore_stockin_pro'=>$select_option,
                    'qty_product_stockin'=> $qty_product,
                    'price_product_stockin'=>$price_product,
                    'total_product_stockin'=>$totalvalues_product,
                    'product_barcode_stockin'=> $barcode_product,
                    'discount_pro_stock'=>$discount_product,
                   ]);
               echo 1;
    }
   public function stock_in_productpos(Request $rq){
    $form_date_values=$rq->form_date_values;
    $form_select_product=$rq->form_select_product;
    $select_option_category=$rq->select_option_category;
    $qty_product=$rq->qty_product;
    $price_product=$rq->price_product;
    $product_totalqty=$rq->product_totalqty;
    $barcodeproduct=$rq->barcodeproduct;
    $discount_product=$rq->discount_product;

   // insert product now
   stockin_product::select('date_stock_in','name_product_stockin','categore_stockin_pro','qty_product_stockin','price_product_stockin','total_product_stockin','product_barcode_stockin','discount_pro_stock')
   ->insert([
    'date_stock_in'=>$form_date_values,
    'name_product_stockin'=>$form_select_product,
    'categore_stockin_pro'=>$select_option_category,
    'qty_product_stockin'=> $qty_product,
    'price_product_stockin'=>$price_product,
    'total_product_stockin'=> $product_totalqty,
    'product_barcode_stockin'=>$barcodeproduct,
    'discount_pro_stock'=>$discount_product,
   ]);
   echo 1;
   }
   // list product
   public function list_stock_in(){
         $select_stockin= stockin_product::get();
          return view("stock.manage_stock_in",compact('select_stockin'));
   }
   // remove function
   public function order_product(Request $rq){
    $form_select_product=$rq->form_select_product;
    DB::table('ordered_product')->select('product_name')
    ->where('product_name',$form_select_product)
    ->delete();
   }
}
