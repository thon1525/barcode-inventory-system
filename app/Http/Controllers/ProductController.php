<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Models\ProductTableModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\SupplierModel;
use Carbon\Carbon;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    //
    public function add(Request $request)
    {
        // $products = CategoryModel::get();

        $product_name = $request->product_name;
        $product_price = $request->product_price;
        $category_id = $request->category_id;
        $product_qty = $request->product_qty;
        $product_code = $request->product_code;
        $supplier_id = $request->supplier_id;
        $date_expire  = $request->date_expire;
        $date_expireDate = Carbon::parse($date_expire);
        $check_barcode = ProductModel::where([
            ['product_code', '=', $product_code],

        ])->first();
        if ($check_barcode) {
            $id = $check_barcode->id;

            return redirect()->back()->with(['barcode' => 'Product with this barcode already exists', 'product_code' => $product_code, 'id' => $id]);
            //  return view('product.add_product', ['product_code' => $product_code]);
        }
        $data = array(
            'product_name' => $product_name,
            'product_price' => $product_price,
            'date_expire' =>   $date_expireDate,
            'category_id' => $category_id,
            'product_qty' => $product_qty,
            'product_code' => $product_code,
            'supplier_id' => $supplier_id
        );
    $product_id =     DB::table('products')->select('product_name', 'category_id', 'supplier_id', 'product_price', 'product_qty', 'product_code', 'date_expire')->insertGetId([
            'product_name' => $product_name,
            'product_price' => $product_price,
            'category_id' => $category_id,
            'product_qty' => $product_qty,
            'date_expire' =>   $date_expireDate,
            'product_code' => $product_code,
            'supplier_id' => $supplier_id,
        ]);

        DB::table('stock_in')->insert([
            'ProductID' => $product_id, // Retrieved product ID
            'Quantity' => $product_qty,        // Product quantity
            'DateIn' => now(),                 // Use current date for DateIn
            'Supplier_id' => $supplier_id,     // Supplier ID
            'UnitCost' => $product_price,      // Unit cost (use product price)

        ]);
        DB::table('stock')->insert([
            'ProductID' => $product_id,       // Set ProductID
            'CurrentStock' => $product_qty,   // Set initial stock quantity
        ]);
        return redirect()->back()->with(['message' => 'Successfully added the product ']);
    }
    public function index()
    {
        $categories = CategoryModel::all();
        $suppliers = SupplierModel::all();
        $products = ProductModel::paginate(10); // Assuming you want pagination

        return view('product.manage_product', [
            'products' => $products,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }
    public function destroy($id)
    {
        DB::table('stock_in')->where('ProductID', $id)->delete();
        ProductTableModel::find($id)->delete();
        return redirect()->back()->with(['message' => 'Successfully deleted the product ']);
    }
    public function view_product($id)
    {
        $category = CategoryModel::get();
        $suppliers = SupplierModel::get();

        // $product = ProductModel::select('*')->where('product_code', $product_code)->first();

        $product = ProductModel::select('*')->where('id', $id)->get();

        return view('product.view_product', ['products' => $product, 'category' => $category, 'suppliers' => $suppliers]);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $update = ProductTableModel::find($id);

        $product_name = $request->product_name;
        $product_price = $request->product_price;
        $product_qty = $request->product_qty;
        // $category_id = ;
        // dd($request->category_id);
        //  echo   $request->file('product_change');
        $product_code = $request->product_code;

        if ($request->file('product_change')) {
            $image_path = public_path('upload/products/') . $update->product_img;
            $request->validate([
                'product_change'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules
            ]);
            if (file_exists($image_path)) {

                @unlink($image_path);
            }

            $file = $request->file('product_change');
            $filename = date('YmuidH') . $file->getClientOriginalName();
            $file->move(public_path('upload/products'), $filename);
            $update['product_img'] = $filename;
        }
        $update->product_name = $product_name;
        $update->product_price = $product_price;
        $update->product_qty = $product_qty;
        $update->category_id = $request->category_id;
        $update->product_code = $product_code;
        $update->save();
        $category = CategoryModel::all();

        $product = ProductModel::select('*')->where('product_code', $product_code)->get();

        return redirect()->back()->with(['message' => 'Successfully edited the product ']);
    }
    public function grid_view()
    {
        $result = ProductModel::get();
        return view('product.grid_view', ['products' => $result]);
    }

    public function add_product()
    {
        $categories = CategoryModel::get();
        $suppliers = SupplierModel::get();
        return view('product.add_product', compact('categories', 'suppliers'));
    }
}
