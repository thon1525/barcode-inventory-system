<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('coupon.index', compact('coupons'));
    }
    public function store(Request $request)
    {
        // Validate and save the new product
        $validatedData = $request->validate([
            'coupon_code' => 'required',
            'discount_percentage' => 'required',
            'expiration_date' => 'required',
            'usage_limit' => 'required',
        ]);

        // Create a new Coupon instance and save it
        $coupon = new Coupon;
        $coupon->fill($validatedData); // Fill the model with validated data
        $coupon->save(); // Save the model to the database

        return redirect()->route('coupon.index')->with('success', 'Coupon saved successfully');
    }

    public function update(Request $request, Coupon $coupon)
    {
        // Validate and save the new product
        $validatedData = $request->validate([
            'coupon_code' => 'required',
            'discount_percentage' => 'required',
            'expiration_date' => 'required',
            'usage_limit' => 'required',
        ]);
        $coupon->update($validatedData);

        return redirect()->route('coupon.index')->with('success', 'Coupon updated successfully');
    }
    public function destroy(Coupon $coupon)
    {
        // Delete the category
        $coupon->delete();
        return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully');
    }

}