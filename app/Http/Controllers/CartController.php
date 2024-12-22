<?php

namespace App\Http\Controllers;

use App\Models\OrderModel;
use App\Models\OrdersModel;
use App\Models\POSModel;
use App\Models\ProductModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductTableModel;
use function Laravel\Prompts\alert;

class CartController extends Controller
{
    // public function add(Request $request){

    //     $product = ProductModel::find($request->product_id);
    //     $product_qty = $product->product_qty;
    //     if (Cart::total() > 0){

    //         foreach(Cart::content() as $item){




    //                 if ($item->id == $request->product_id){
    //                         if ($request->qty + $item->qty > $product_qty){
    //                              $no_stock = 1;


    //                        }
    //                        else if ($request->qty + $item->qty <= $product_qty){
    //                            $have_stock = 1;

    //                       }
    //                        }
    //               else {
    //                 $no_item_in_cart = 1;


    //               }

    //          }
    //          if (isset($no_stock)){
    //             return redirect()->back()->with('error_add_to_cart', 'No stock' );
    //          }else if (isset($have_stock)){
    //             Cart::add($product->id, $product->product_name, $request->qty, $product->product_price);
    //             return redirect()->back()->with('message', 'Successfully added' . $item->qty);

    //          }else if (isset($no_item_in_cart)){

    //             Cart::add($product->id, $product->product_name, 1, $product->product_price);
    //             return redirect()->back()->with('message', 'Successfully added');

    //          }
    //         }
    //      else {
    //         Cart::add($product->id, $product->product_name, $request->qty, $product->product_price);
    //         return redirect()->back()->with('message', 'Successfully added');

    //      }



    // }


    public function add(Request $request)
    {
        $product = ProductModel::findOrFail($request->product_id); // Use findOrFail for a safer call
        $productQty = $product->product_qty;

        // Check if the product is already in the cart
        $itemInCart = Cart::search(function ($item) use ($product) {
            return $item->id === $product->id;
        })->first();

        if ($itemInCart) {
            $totalQty = $request->qty + $itemInCart->qty;

            if ($totalQty > $productQty) {
                return redirect()->back()->with('error_add_to_cart', 'No stock');
            } else {
                Cart::update($itemInCart->rowId, $totalQty);
            }
        } else {
            if ($request->qty > $productQty) {
                return redirect()->back()->with('error_add_to_cart', 'No stock');
            }
            Cart::add($product->id, $product->product_name, $request->qty, $product->product_price);
        }

        return redirect()->back()->with('message', 'Successfully added');
    }




    public function add_barcode(Request $request)
    {
        $product_id = $request->barcodeproduct_id;

        $product_qty = $request->barcodeproduct_qty;
        $product = ProductModel::find($product_id);


        Cart::add($product->id, $product->product_name, $product_qty, $product->product_price);
        // return redirect()->back()->with('message', 'Successfully added');

    }

    public function addBarcode(Request $request)
    {
        $validated = $request->validate([
            'barcodeproduct_id' => 'required|exists:products,id',
            'barcodeproduct_qty' => 'required|integer|min:1'
        ]);

        $product = ProductModel::find($validated['barcodeproduct_id']);
        Cart::add($product->id, $product->product_name, $validated['barcodeproduct_qty'], $product->product_price);

        return redirect()->back()->with('message', 'Successfully added via barcode');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'row_id' => 'required|string'
        ]);

        Cart::remove($request->row_id);
        return redirect()->back()->with('remove', 'Successfully removed');
    }


    public function create_order(Request $rq)
    {
        DB::beginTransaction(); // Start transaction


        $customer_name = $rq->dbconcustomer_name;
        $grand_total = $rq->dbcongrand_total;

        $product_id = $rq->dbconproduct_id;
        $product_name = $rq->dbconproduct_name;
        $product_qty = $rq->dbconproduct_qty;
        $product_price = $rq->dbconproduct_price;
        $product_discount = $rq->dbconproduct_discount;
        $product_total = $rq->dbconproduct_total;


        $last = POSModel::latest('order_id')->first();
        $order_id_insert = $last ? $last->order_id + 1 : 1;
        DB::table('pos')->insert(
            [
                'customer_name' => $customer_name,
                'po_name' => 'Order#' . $order_id_insert,
                'grand_total' => $grand_total,
                'order_id' => $order_id_insert
            ]
        );



        $data = array();
        for ($i = 0; $i < count($product_name); $i++) {
            $data = array('product_name' => $product_name[$i], 'product_qty' => $product_qty[$i], 'product_price' => $product_price[$i], 'product_discount' => $product_discount[$i], 'product_total' => $product_total[$i], 'order_id' => $order_id_insert, 'product_id' => $product_id[$i]);

            OrderModel::insertOrIgnore($data);
        }
        for ($i = 0; $i < count($product_name); $i++) {

            DB::table('products')->where('id', $product_id[$i])->decrement('product_qty', $product_qty[$i]);
        }
        DB::commit(); // Commit transaction
        $product_stock = DB::table('products')
        ->select('id', 'product_qty')
        ->where('id', $product_id)
        ->first();

        DB::table('stock_in')
        ->where('ProductID', $product_id)
        ->update([
            'Quantity' => $product_stock->product_qty,
        ]);
        DB::table('stock')->where('ProductID', $product_id)
        ->update([
            'CurrentStock' => $product_stock->product_qty,
        ]);

        // Clear the cart
        Cart::destroy();
        // return redirect()->back()->with('message', 'Successfully Created Order');

    }
}
