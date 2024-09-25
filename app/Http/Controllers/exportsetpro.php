<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class exportsetpro extends Controller
{
    public function funproduct_set(){
       $producttax=     DB::table('product_importhastax')->select('name_producttax')->get();
        return view('export_product.exportpro',compact('producttax'));
    }
    // create fucntion in laravel
    public function funproduct_condition(Request $rq){
       $selectoptionpro=$rq->selectoptionpro;
       $productset = DB::table('product_importhastax')
       ->leftJoin('categories','product_importhastax.category_id', '=', 'categories.catid')
      ->leftJoin('suppliers', 'product_importhastax.supplier_id', '=', 'suppliers.id')
       ->select('product_importhastax.name_producttax',
         'product_importhastax.price_producttax',
         'product_importhastax.qty_producttax',
         'product_importhastax.dis_producttax',
         'product_importhastax.total_productta',
         'product_importhastax.date',
         'product_importhastax.dateexpire',
         'product_importhastax.barcode_taxproduct',
         'product_importhastax.tax_product',
       'categories.catid',
       'categories.category_name',
       'suppliers.id',
       'suppliers.supplier_name',
       )
       ->where('product_importhastax.name_producttax',$selectoptionpro)
      ->get();
       return $productset;
      // print_r($productset);
      // databae


    }
    // $this->thon(Request $request);


    // this thon is function
    public function funsellproduct(Request $request){
      $nameproduct=$request->nameproduct;
      $optiontakeproduct=$request->optiontakeproduct;
      $qtypro=$request->qtypro;
      $totalproduct=$request->totalproduct;
      $Category=$request->Category;
      $supplier=$request->supplier;
      $datestart=$request->datestart;
      $expriredate=$request->expriredate;
      $barcode_taxproduct=$request->barcode_taxproduct;
      $persentproduct=$request->persentproduct;

      $historyprice=$request->historyprice;
      $historytotal=$request->historytotal;
      $historydiscount=$request->historydiscount;
      $historytaxproduct=$request->historytaxproduct;
     $historyqtypro=$request->historyqtypro;

    DB::table('product_sellready')->insert([
       'name_productsell'=>$nameproduct,
       'price_productsell'=>$optiontakeproduct,
       'qty_productsell'=>$qtypro,
       'total_productsell'=>$totalproduct,
       'category_productsell'=>$Category,
       'supllies_productsell'=>$supplier,
      // 'date_sarte'=>$datestart,
       'date_exprire'=>$expriredate,
       'barcode'=>$barcode_taxproduct,
       'persent_product'=>$persentproduct,

    ]);



   DB::table('product_importhastax')->select('name_producttax')->where('name_producttax',$nameproduct)->delete();

   DB::table('product_importhastaxhistory')->select(
    'name_producttax',
    'price_producttax',
    'qty_producttax',
    'dis_producttax',
    'total_productta',
    'tax_product',
    'category_id',
    'supplier_id',
    'date',
    'barcode_taxproduct',
    'dateexpire',
    )
    ->insert([
     'name_producttax'=>$nameproduct,
     'price_producttax'=>$historyprice,
     'qty_producttax'=>$historyqtypro,
     'dis_producttax'=>$historydiscount,
     'total_productta'=>$historytotal,
     'tax_product'=>$historytaxproduct,
     'category_id'=>$Category,
     'supplier_id'=>$supplier,
     'date'=>$datestart,
     'barcode_taxproduct'=>$barcode_taxproduct,
     'dateexpire'=>$expriredate,
    ]);

     echo 1;

    }

}
