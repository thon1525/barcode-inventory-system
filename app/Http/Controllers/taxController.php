<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class taxController extends Controller
{
    // tax product
    public function viewtax()
    {

        return view('taxproduct.viewtax');
    }
    // magament tax
    public function managetax()
    {
        $category = DB::table('categories')
            ->select('catid', 'category_name')
            ->get();

        // Retrieve tax products
        $taxproduct = DB::table('taxproduct')->get();

        // Return both categories and tax products to the view
        return view('taxproduct.managetax', compact('taxproduct', 'category'));
    }
    public function update(Request $request, $tax)
    {
        // Validate and save the new product
        $validatedData = $request->validate([
            'nametax' => 'required',
            'price_tax' => 'required'
        ]);
        $validatedData['price_tax'] /= 100;
        $validatedData['nametax'];
        //  $tax->update($validatedData);
        DB::table('taxproduct')->where('id_tex', $tax)->update($validatedData);
        return redirect()->route('view.manage.tax')->with('success', 'Tax updated successfully');
    }
    public function destroy($tax)
    {
        //  Tax $tax;
        // Delete the category
        DB::table('taxproduct')->where('id_tex', $tax)->delete();
        //  $tax->delete();
        return redirect()->route('view.manage.tax')->with('success', 'Tax deleted successfully');
    }
}
