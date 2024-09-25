<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\exportsetpro;
use App\Http\Controllers\stockController;
use App\Http\Controllers\taxController;
use App\Http\Controllers\importproductController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\listtaxproductController;
use App\Http\Controllers\ScrapeproController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('/auth/login');
})->name('login');

Route::get('/register', function () {
    return view('/auth/register');
})->name('register');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');
//create customer in dashboard

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/view', [ProfileController::class, 'profile_store'])->name('profile.store');

    Route::get('/profile/view', [ProfileController::class, 'profile'])->name('profile.view');


    Route::get('/category/add_category', [CategoryController::class, 'add_category']);
    Route::post('/category/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/category/delete_category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::post('/category/add_category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::get('/category/manage_category', [CategoryController::class, 'index'])->name('category.index');



    Route::get('/product/manage_product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product/add_product/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('/product/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/product/grid_view', [ProductController::class, 'grid_view'])->name('product.grid_view');
    Route::get('/product/add_product', [ProductController::class, 'add_product']);
    Route::delete('/product/delete_product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/view_product/{product_code}', [ProductController::class, 'view_product'])->name('product.view_product');
    // Route::post('/product/grid_view/edit', [ProductController::class, 'grid_view_edit'])->name('product.grid.edit');


    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::get('/pos/add/{id}', [POSController::class, 'add'])->name('pos.add');
    Route::get('/pos/add_table', [POSController::class, 'add_table'])->name('pos.add_table');
    Route::get('/pos/manage', [POSController::class, 'manage'])->name('pos.manage');
    Route::get('/pos/print_pdf/{id}', [POSController::class, 'print_pdf'])->name('pos.print_pdf');
    Route::get('/pos/view_pdf/{id}', [POSController::class, 'view_pdf'])->name('pos.view_pdf');
    Route::get('/pos/delete/{id}', [POSController::class, 'delete'])->name('pos.delete');
    Route::post('/select-category', [POSController::class, 'post_function'])->name('pos.po');


    Route::post('/', [CartController::class, 'add'])->name('cart.add');
    Route::post('/add_to_cart', [CartController::class, 'add_barcode'])->name('cart.add_barcode');

    Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/create_order', [CartController::class, 'create_order'])->name('cart.create_order');


    Route::get('/supplier/manage_supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::post('/supplier/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
    Route::delete('/supplier/delete_supplier/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    Route::post('/supplier/add', [SupplierController::class, 'add'])->name('supplier.add');
    Route::get('/supplier/add_supplier', function(){
        return view('supplier.add_supplier');
    });
    // add stock in laravel
    Route::get('/product/stock_in/',[stockController::class,'stock_in'])->name('product.stock_in');
    Route::post('/product/stock_in/product/search',[stockController::class,'searchproducts'])->name('search.product');
    Route::post('/product/stock_in/product/add_stock_in',[stockController::class,'stock_in_product'])->name("stockin.product");
    Route::post('/product/stock_in/product/add_stock_inpos',[stockController::class,'stock_in_productpos'])->name("stockin.posproduct");
     // add list stock in
     Route::get('/product/stock_in/product/manage_stock_in',[stockController::class,'list_stock_in'])->name('list.product.stock_in');
     // remouve product in order product
     Route::post('/product/stock_in/product/delect',[stockController::class,'order_product'])->name("stockin.product.remove");
     // add tax product for businness
     Route::get('/view/tax',[taxController::class,'viewtax'])->name('view.tax');
     Route::get('/view/manage/tax',[taxController::class,'managetax'])->name('view.manage.tax');
    Route::put('/tax/{tax}', [taxController::class, 'update'])->name('tax.update');
    Route::delete('/tax/{tax}', [taxController::class, 'destroy'])->name('tax.destroy');
     // add product import for businness in ecommercer
     Route::get('/import_product/add_product',[importproductController::class,'funimport'])->name('addimport.product');
     Route::post('/import_product/add_product/add_import',[importproductController::class,'funaddimportpro'])->name('addimport.product.add_import');
     Route::get('/import_product/add_product/view_product',[importproductController::class,'funviewproduct'])->name('addimport.product.view.product');
     Route::delete('/import_product/add_product/view_product/delete/{id}',[importproductController::class,'funviewproductdelete'])->name('import.product.destroy');
     Route::get('/import_product/add_product/view_product/update/{id_edit}',[importproductController::class,'funviewediteproduct'])->name('export.product.view_product');
     Route::post('/import_product/add_product/view_product/update/import/product',[importproductController::class,'funimportupdatefunction'])->name('import.product.edit');
    // import product stock in for import
    Route::get('/stock_in/manage_product_stock_in',[importproductController::class,'funstockin_import'])->name('list.stock.in.import');
    Route::post('/stock_in/manage_product_stock_in/update_stockin',[importproductController::class,'funstockin_import_update'])->name('list.stock.in.import.update');
    Route::delete('/stock_in/manage_product_stock_in/{id_stock_in_import}',[importproductController::class,'destroy'])->name('list.stock.in.import.delete');
    Route::post('/stock_in/manage_product_stock_in/update_stockin/view/edit/update',[importproductController::class,'funstockin_import_stockin_edit_update_all'])->name('list.stock.in.import.update.edit.stockin.update.all');
     //crud about coupons
    Route::get('/coupon/list', [CouponController::class, 'index'])->name('coupon.index');
    Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');
    // Route::get('/coupon', [CouponController::class, 'index'])->name('coupon.index');
    Route::put('/coupon/{coupon}', [CouponController::class, 'update'])->name('coupon.update');
    Route::delete('/coupon/{coupon}', [CouponController::class, 'destroy'])->name('coupon.destroy');
    //crud about promotions
    Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion.index');
    Route::post('/promotion', [PromotionController::class, 'store'])->name('promotion.store');
    Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion.index');
    Route::put('/promotion/{promotion}', [PromotionController::class, 'update'])->name('promotion.update');
    Route::delete('/promotion/{promotion}', [PromotionController::class, 'destroy'])->name('promotion.destroy');
  // add list product useing tax product
Route::get('/add_producttax',[listtaxproductController::class,'funlisttaxproduct'])->name('add.tax.product.price');
Route::post('/add_producttax/insert_data_tax',[listtaxproductController::class,'funlisttaxinsert_product'])->name('add.tax.product.insert.product');
Route::post('/add_producttax/insert_data_tax/product/insert',[listtaxproductController::class,'funlisttaxtodatabase'])->name('add.tax.product.insert.product.to.database');
Route::get('/manage/product/view_tax',[listtaxproductController::class,'funshowtaxproduct'])->name('show.tax.product.view');
// add new product scripper otherecommer
Route::get('/view/see/show_data',[ScrapeproController::class,'scrapecommerces'])->name('view.ecommerce.online');
// add new product export for set data
Route::get('/view/export/set_product',[exportsetpro::class,'funproduct_set'])->name('view.set.porduct.export');
Route::post('/view/export/set_product/condition',[exportsetpro::class,'funproduct_condition'])->name('view.set.porduct.export.condition.data');
Route::post('/view/export/set_product/condition/install/add',[exportsetpro::class,'funsellproduct'])->name('view.set.porduct.export.condition.data.sell.data');
});
require __DIR__ . '/auth.php';

// you can write account employee
Route::middleware(['auth','role:employee' ])->group(function(){
 Route::get('/employee/index', [EmployeeController::class, 'index'])->name('employee.index');

});
// you can write account customer with
Route::middleware(['auth','role:customer'])->group(function(){
    Route::get('/customer/index', [customerController::class, 'index'])->name('customer.index');

});
// account user online all no update mrr yany
Route::middleware(['auth','role:userapi'])->group(function(){
   Route::get('/user',function(){
    return 'hello thon user';
   });

});
