<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use  App\Models\stock_in_importpro;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\File;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Storage;


class importproductController extends Controller
{
    public function funimport(){
     $categories =   DB::table('categories',)->select('category_name','catid')->get();
     $suppliers = DB::table('suppliers','id')->select('supplier_name','id')->get();
        return view("importpro.import_product",compact('categories','suppliers'));
    }
    public function funaddimportpro(Request $rq){
     $importpro=$rq->importpro;
     $importproductprice=$rq->importproductprice;
     $productimportqty=$rq->productimportqty;
     $addsupplierval=$rq->addsupplierval;
     $categoryproduct=$rq->categoryproduct;
     $productbarcode=$rq->productbarcode;
     $importprodutotal=$rq->importprodutotal;
     $dateexpire=$rq->dateexpire;
     // total product
     DB::table('import_product')->select('namepro_import','proprice_import','progty_import','procate_import','prosupp_import','barcodepro_import','total_product','dateexpire','date_importpro')->
     insert([
        'namepro_import'=>$importpro,
        'proprice_import'=>$importproductprice,
        'progty_import'=>$productimportqty,
        'procate_import'=>$categoryproduct,
        'prosupp_import'=>$addsupplierval,
        'barcodepro_import'=>$productbarcode,
        'total_product'=>$importprodutotal,
        'dateexpire'=>$dateexpire,
     ]);
     DB::table('stock_in_importpro')->select('stockin_imporn','stockin_price','stockin_qty','category_import','supplie_import','barcode_import','total_product','dateexpire','date_importpro')->insert([
        'stockin_imporn'=>$importpro,
        'stockin_price'=>$importproductprice,
        'stockin_qty'=>$productimportqty,
        'category_import'=>$categoryproduct,
        'supplie_import'=>$addsupplierval,
        'barcode_import'=>$productbarcode,
        'total_product'=>$importprodutotal,
        'dateexpire'=>$dateexpire,
     ]);
     echo  1;
    }
    // add public function
    public function funstockin_import(){
      $stock_in_import = DB::table('stock_in_importpro')
      ->leftJoin('categories', 'stock_in_importpro.category_import', '=', 'categories.catid')
      ->leftJoin('suppliers', 'stock_in_importpro.supplie_import', '=', 'suppliers.id')
      ->select('stock_in_importpro.id_stock_in_import','categories.category_name','suppliers.supplier_name',
      'stock_in_importpro.stockin_imporn',
      'stock_in_importpro.stockin_price',
      'stock_in_importpro.stockin_qty',
      'stock_in_importpro.barcode_import',
      'stock_in_importpro.total_product',
      'stock_in_importpro.date_import',
      'stock_in_importpro.dateexpire',
      'stock_in_importpro.image_productstockin',
      )
       ->get();
        return view('stockinimport_product.stockin_import',compact('stock_in_import'));
    }
    // add publice function
    public function funstockin_import_update(Request $request){

     $itemstockin=$request->input('itemstockin');
     
   //  $stockinendit =  DB::table('stock_in_importpro')->select('id','stockin_imporn','stockin_price','stockin_qty','category_import','supplie_import','barcode_import')->where('id',$itemstockin)->get();
    $stockinendit = DB::table('stock_in_importpro')
    ->leftJoin('categories', 'stock_in_importpro.category_import', '=', 'categories.catid')
    ->leftJoin('suppliers', 'stock_in_importpro.supplie_import', '=', 'suppliers.id')
    ->select('stock_in_importpro.id_stock_in_import','categories.catid','categories.category_name','suppliers.id','suppliers.supplier_name',
    'stock_in_importpro.stockin_imporn',
    'stock_in_importpro.stockin_price',
    'stock_in_importpro.stockin_qty',
    'stock_in_importpro.barcode_import',
    'stock_in_importpro.image_productstockin',
    'stock_in_importpro.total_product',
    'stock_in_importpro.date_import',
    )
    ->where('stock_in_importpro.id_stock_in_import', $itemstockin)
   ->get();

  $catename=  DB::table('categories')->select('catid','category_name')
    ->get();
   //return  $stockinendit;
   // add supplie in ecommerce
   $supplieproductimage =  DB::table('suppliers')->select('id','supplier_name')->get();
     return view('stockinimport_product.editstockin',compact('stockinendit','catename','supplieproductimage'));

    }
    // update project in laravel
    public function funstockin_import_stockin_edit_update_all(Request $rq){
          $valstockinid=$rq->valstockinid;
           $stockinmport=$rq->stockinmport;
           $stockinprice=$rq->stockinprice;
           $stockin_qty=$rq->stockin_qty;
           $categoruser_id=$rq->categoruser_id;
           $supplier_iduser=$rq->supplier_iduser;
           $stockinbarcode=$rq->stockinbarcode;
           $editproducttotal=$rq->editproducttotal;
           $datestare=$rq->datestare;
           $imageData=$rq->input('imagefile');
           $image = base64_decode($imageData);
           $fiename=$rq->input('imagename');
      
        $updatedb=   DB::table('stock_in_importpro')->select('image_productstockin')->where('id_stock_in_import',$valstockinid)->first();
        if($rq->input('imagefile')){
        // $image_path = public_path('upload/stockin_image'). '/' .$updatedb->image_productstockin;
         $image_path = public_path('upload/stockin_image') . '/'  .$updatedb->image_productstockin;

       
         if (File::exists($image_path)) {
          File::delete($image_path);
         }
          file_put_contents(public_path('upload/stockin_image') . '/' .  $fiename,  $image);

            $stockinendit = DB::table('stock_in_importpro')
            ->leftJoin('categories', 'stock_in_importpro.category_import', '=', 'categories.catid')
            ->leftJoin('suppliers', 'stock_in_importpro.supplie_import', '=', 'suppliers.id')
            ->select('categories.catid','suppliers.id','stock_in_importpro.id_stock_in_import',
            'stock_in_importpro.stockin_imporn',
            'stock_in_importpro.stockin_price',
            'stock_in_importpro.stockin_qty',
            'stock_in_importpro.barcode_import',
            'stock_in_importpro.total_product',
            'stock_in_importpro.date_import',
            'stock_in_importpro.image_productstockin',
            )
            ->where('stock_in_importpro.id_stock_in_import',$valstockinid)
            ->update([
              'stock_in_importpro.stockin_imporn'=>$stockinmport,
              'stock_in_importpro.stockin_price'=>$stockinprice,
              'stock_in_importpro.stockin_qty'=>$stockin_qty,
              'stock_in_importpro.category_import'=>$categoruser_id,
              'stock_in_importpro.supplie_import'=>$supplier_iduser,
              'stock_in_importpro.barcode_import'=>$stockinbarcode,
              'stock_in_importpro.total_product'=>$editproducttotal,
              'stock_in_importpro.image_productstockin'=>$fiename,
            ]);
      echo 1;
       }else{
        $stockinendit = DB::table('stock_in_importpro')
        ->leftJoin('categories', 'stock_in_importpro.category_import', '=', 'categories.catid')
        ->leftJoin('suppliers', 'stock_in_importpro.supplie_import', '=', 'suppliers.id')
        ->select('categories.catid','suppliers.id','stock_in_importpro.id_stock_in_import',
        'stock_in_importpro.stockin_imporn',
        'stock_in_importpro.stockin_price',
        'stock_in_importpro.stockin_qty',
        'stock_in_importpro.barcode_import',
        'stock_in_importpro.total_product',
        'stock_in_importpro.date_import',
        )
        ->where('stock_in_importpro.id_stock_in_import',$valstockinid)
        ->update([
          'stock_in_importpro.stockin_imporn'=>$stockinmport,
          'stock_in_importpro.stockin_price'=>$stockinprice,
          'stock_in_importpro.stockin_qty'=>$stockin_qty,
          'stock_in_importpro.category_import'=>$categoruser_id,
          'stock_in_importpro.supplie_import'=>$supplier_iduser,
          'stock_in_importpro.barcode_import'=>$stockinbarcode,
          'stock_in_importpro.total_product'=>$editproducttotal,
        ]);
  echo 1;
       }

    }
  
    // create publice function datale
    public function destroy($id_stock_in_import){

      $stockItem = stock_in_importpro::where('id_stock_in_import',$id_stock_in_import);

      // Delete the stock item
      $stockItem->delete();
      return redirect()->back()->with('success', 'Stock item deleted successfully.');
    }
    // view product
   public function funviewproduct(){
    $productimport = DB::table('import_product')
    ->leftJoin('categories', 'import_product.procate_import', '=', 'categories.catid')
    ->leftJoin('suppliers', 'import_product.prosupp_import', '=', 'suppliers.id')
    ->select('import_product.id_importpro','categories.catid','categories.category_name','suppliers.id','suppliers.supplier_name',
  'import_product.namepro_import',
  'import_product.proprice_import',
  'import_product.progty_import',
  'import_product.procate_import',
  'import_product.prosupp_import',
  'import_product.barcodepro_import',
  'import_product.date_import',
  'import_product.total_product',
  'import_product.dateexpire',
  'import_product.image_product',
    )
   ->get();

    return view('importpro.viewimport',compact('productimport'));

    }
    // delete
    public function funviewproductdelete($id){
    DB::table('import_product')->where('id_importpro',$id)->delete();
    return redirect()->back()->with(['message' => 'Successfully deleted the product ']);
    }
    // update function
    public function funviewediteproduct($id_edit){

        $productimportupdate = DB::table('import_product')
    ->leftJoin('categories', 'import_product.procate_import', '=', 'categories.catid')
    ->leftJoin('suppliers', 'import_product.prosupp_import', '=', 'suppliers.id')
    ->select('import_product.id_importpro','categories.catid','categories.category_name','suppliers.id','suppliers.supplier_name',
  'import_product.namepro_import',
  'import_product.proprice_import',
  'import_product.progty_import',
  'import_product.procate_import',
  'import_product.prosupp_import',
  'import_product.barcodepro_import',
  'import_product.date_import',
  'import_product.total_product',
  'import_product.dateexpire',
  'import_product.image_product',
    )
   ->where('import_product.id_importpro',$id_edit)
   ->get();
   $category=  DB::table('categories')->select('category_name','catid')->get();
   $suppliers = DB::table('suppliers')->select('supplier_name','id')->get();
    // print_r($productimportupdate);
      return view('importpro.updateimport',compact('productimportupdate','category','suppliers'));
    }
    // update import product in import
    public function funimportupdatefunction(Request $request){
        $idproduct=$request->input('idproduct');
        $product_name= $request->input('product_name');
         $product_price=$request->input('product_price');
         $product_qty=$request->input('product_qty');
         $category_id=$request->input('category_id');
         $supplier_id=$request->input('supplier_id');
         $product_code=$request->input('product_code');
         $product_total=$request->input('product_total');
         $product_dateexprice=$request->input('product_dateexprice');
         $dateimport=$request->input('dateimport');
         $time = strtotime($product_dateexprice);
         $newformat = date('Y-m-d',$time);

         $update = DB::table('import_product')->select('image_product')->where('id_importpro',$idproduct)->first();
         // stockin product product
      $stock_in_importpro=DB::table('stock_in_importpro')->select('image_productstockin')->first();
      $stock_in_importprodatestate=DB::table('stock_in_importpro')->select('date_import')->first();
      $stock_in_importprodatenamestockin=DB::table('stock_in_importpro')->select('stockin_imporn')->first();
        // end  stockin product product
         if ($request->file('product_change')){
            $image_path = public_path('upload/products/').$update->image_product;
            $request->validate([
                'product_change'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules

             ]);
            if (file_exists($image_path)) {

                @unlink($image_path);

            }

            $file = $request->file('product_change');

            $filename = date('YmuidH').$file->getClientOriginalName();
          //  $file->move(public_path('upload/products'), $filename);
          $destinationPath1 = public_path('upload/products');
            $destinationPath2 = public_path('upload/stockin_image');
            $file->move($destinationPath1, $filename);
            // Create a copy in the second destination
          $filePath1 = $destinationPath1 . '/' . $filename;
        
        //    $update->image_product = $filename;
                // Use Laravel's Filesystem to copy the file
    //  
           // update import product
            $productimportupdate = DB::table('import_product')
            ->leftJoin('categories', 'import_product.procate_import', '=', 'categories.catid')
            ->leftJoin('suppliers', 'import_product.prosupp_import', '=', 'suppliers.id')
            ->select('import_product.id_importpro','categories.catid','suppliers.id',
          'import_product.namepro_import',
          'import_product.proprice_import',
          'import_product.progty_import',
          'import_product.procate_import',
          'import_product.prosupp_import',
          'import_product.barcodepro_import',
         // 'import_product.date_import',
          'import_product.total_product',
          'import_product.dateexpire',
          'import_product.image_product',
            )
           ->where('import_product.id_importpro',$idproduct)
           ->update(['import_product.namepro_import'=> $product_name,
           'import_product.proprice_import'=> $product_price,
           'import_product.progty_import'=> $product_qty,
           'import_product.procate_import'=> $category_id,
           'import_product.prosupp_import'=> $supplier_id,
           'import_product.barcodepro_import'=> $product_code,
           'import_product.total_product'=> $product_total,
           'import_product.dateexpire'=> $product_dateexprice,
          'import_product.image_product'=>$filename,
        ]);
          // end update import product
         // $file->move(public_path('upload/stockin_image'),$filename);
          // strate update stockin import product
          if(($stock_in_importpro->image_productstockin==null)){
            $filePath2 = $destinationPath2 . '/' . $filename;
            File::copy($filePath1, $filePath2);
            $stockinendit = DB::table('stock_in_importpro')
            ->leftJoin('categories', 'stock_in_importpro.category_import', '=', 'categories.catid')
            ->leftJoin('suppliers', 'stock_in_importpro.supplie_import', '=', 'suppliers.id')
            ->select('categories.catid','suppliers.id',
            'stock_in_importpro.stockin_imporn',
            'stock_in_importpro.stockin_price',
            'stock_in_importpro.stockin_qty',
            'stock_in_importpro.barcode_import',
            'stock_in_importpro.total_product',
            'stock_in_importpro.dateexpire',
            'stock_in_importpro.date_import',
            'stock_in_importpro.image_productstockin',
            )
           ->where('stock_in_importpro.stockin_imporn',$stock_in_importprodatenamestockin->stockin_imporn)
             ->where('stock_in_importpro.date_import',$stock_in_importprodatestate->date_import)
            ->update([
              'stock_in_importpro.stockin_imporn'=>$product_name,
              'stock_in_importpro.stockin_price'=>$product_price,
              'stock_in_importpro.stockin_qty'=>$product_qty,
              'stock_in_importpro.category_import'=>$category_id,
              'stock_in_importpro.supplie_import'=>$supplier_id,
              'stock_in_importpro.barcode_import'=>$product_code,
              'stock_in_importpro.total_product'=>$product_total,
              'stock_in_importpro.dateexpire'=>$product_dateexprice,
              'stock_in_importpro.image_productstockin'=> $filename,
            ]);
          }
              

           // end update stockin import product
        return redirect()->back()->with(['message' => 'Successfully  the product ']);
        }else{
            $productimportupdate = DB::table('import_product')
            ->leftJoin('categories', 'import_product.procate_import', '=', 'categories.catid')
            ->leftJoin('suppliers', 'import_product.prosupp_import', '=', 'suppliers.id')
            ->select('import_product.id_importpro','categories.catid','suppliers.id',
          'import_product.namepro_import',
          'import_product.proprice_import',
          'import_product.progty_import',
          'import_product.procate_import',
          'import_product.prosupp_import',
          'import_product.barcodepro_import',
          //'import_product.date_import',
          'import_product.total_product',
          'import_product.dateexpire',
            )
           ->where('import_product.id_importpro',$idproduct)
           ->update(['import_product.namepro_import'=> $product_name,
           'import_product.proprice_import'=> $product_price,
           'import_product.progty_import'=> $product_qty,
           'import_product.procate_import'=> $category_id,
           'import_product.prosupp_import'=> $supplier_id,
           'import_product.barcodepro_import'=> $product_code,
           'import_product.total_product'=> $product_total,
           'import_product.dateexpire'=> $product_dateexprice,

        ]);
   return redirect()->back()->with(['message' => 'Successfully  the product ']);
        }

        // $validated = $request->validate([
        //     'namepro_import' => 'required',
        //     'proprice_import' =>  'required|regex:/^\d*(\.\d{2})?$/',
        //     'progty_import'  =>'required',
        //     'procate_import'=>'required_with:end_page|integer|min:1|digits_between: 1,1000000',
        //     'prosupp_import'=>'required_with:end_page|integer|min:1|digits_between: 1,1000000',
        //     'barcodepro_import'=>'required',
        //     'dateexpire'=>'required',
        //     'total_product'=>'required|regex:/^\d*(\.\d{2})?$/',
        //     'image_product'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        // ]);


    }
}
