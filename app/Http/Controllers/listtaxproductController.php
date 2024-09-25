<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class listtaxproductController extends Controller
{
    // add product in list
    public function funlisttaxproduct(){
        $product_stockin=DB::table('stock_in_importpro')->select('stockin_imporn')->get();
        $taxproduct=DB::table('taxproduct')->select('id_tex','price_tax','nametax')->get();
        // $categorytax=DB::table('categories')->select('catid')->get();
        return view('listproduct_tax.listtax_product',compact('product_stockin','taxproduct',));
    }
    // end product in list
    public function funlisttaxinsert_product(Request $request){
       $add_tax_import=$request->add_tax_import;

       $stockintax = DB::table('stock_in_importpro')
       ->leftJoin('categories', 'stock_in_importpro.category_import', '=', 'categories.catid')
       ->leftJoin('suppliers', 'stock_in_importpro.supplie_import', '=', 'suppliers.id')
       ->select('stock_in_importpro.id_stock_in_import','categories.catid','categories.category_name','suppliers.id','suppliers.supplier_name',
       'stock_in_importpro.stockin_imporn',
       'stock_in_importpro.stockin_price',
       'stock_in_importpro.stockin_qty',
       'stock_in_importpro.barcode_import',
       'stock_in_importpro.total_product',
       'stock_in_importpro.dateexpire',
       'stock_in_importpro.image_productstockin',
       )
       ->where('stock_in_importpro.stockin_imporn',$add_tax_import)
      ->get();
       return $stockintax;
          // delete when click

    }
    // create function database in jquery in
    public function funlisttaxtodatabase(Request $rq){
        $nameproductinsert=$rq->nameproductinsert;
        $priceproducttax=$rq->priceproducttax;
        $qtyproducttaxval=$rq->qtyproducttaxval;
        $discountroductaxval=$rq->discountroductaxval;
        $totaltroductaxval=$rq->totaltroductaxval;
        // insert id in jquery

        $catedtaxproduct=$rq->catedtaxproduct;
        $supplietaxid=$rq->supplietaxid;
        $barcodetaxproduct=$rq->barcodetaxproduct;
        $texproductselect=$rq->texproductselect;
        $dateexpire=$rq->dateexpire;
        $date= now();

        // insert data
        $stockintax = DB::table('product_importhastax')
        ->insert([
            'name_producttax'=>$nameproductinsert,
            'price_producttax'=>$priceproducttax,
            'qty_producttax'=>$qtyproducttaxval,
            'dis_producttax'=>$discountroductaxval,
            'total_productta'=>$totaltroductaxval,
            'tax_product'=>$texproductselect,
            'category_id'=>$catedtaxproduct,
            'supplier_id'=>$supplietaxid,
            'barcode_taxproduct'=>$barcodetaxproduct,
            'dateexpire'=>$dateexpire,
            'date'=>$date,
        ]);
        echo 1;

        DB::table('stock_in_importpro')->select('stockin_imporn')->where('stockin_imporn',$nameproductinsert)->delete();

        // end insert data
    }
    // show view
    public function funshowtaxproduct(){
//    $listproduct=   DB::table('products')
//       ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
//       ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
//        ->select('products.product_name',
//        'products.product_name',
//        'products.product_code',
//        'products.product_price',
//        'products.product_img',
//        )
//        ->where('products.product_name','Coca')
//        ->get();

//        $listproduct=   DB::table('products')
//        ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
//        ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
//         ->select('products.product_name',
//         'products.product_code',
//         'products.product_price',
//         'products.product_img',
//         )
//         ->where('products.product_name','Coca')
//         ->get();

//         $showone= DB::table('products')
//         ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
//         ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
//          ->select('products.product_name',
//          'products.product_name',
//          'products.product_code',
//          'products.product_price',
//          'products.product_img',
//          )
//          ->where('products.product_name','vital')
//          ->get();

//          $showdrink= DB::table('products')
//          ->leftJoin('categories', 'products.category_id', '=', 'categories.catid')
//          ->leftJoin('suppliers', 'products.supplier_id', '=', 'suppliers.id')
//           ->select('products.product_name',
//           'products.product_name',
//           'products.product_code',
//           'products.product_price',
//           'products.product_img',
//           )
//           ->where('products.product_name','drink meil')
//           ->get();

          $showmail= DB::table('products')->select('product_name','product_code','product_img','product_price')
          ->where('product_name','Coca')
          ->get();

      return view('listproduct_tax.managetax',compact('showmail'));
    }

}
