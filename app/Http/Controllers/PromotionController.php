<?php
namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('promotion.index', compact('promotions'));
    }
    public function store(Request $request)
    {
        // Validate and save the new promotion
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'discount_type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_purchase' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        // Create a new Coupon instance and save it
        $promotion = new Promotion;
        $promotion->fill($validatedData); // Fill the model with validated data
        $promotion->save(); // Save the model to the database
        return redirect()->route('promotion.index')->with('success', 'promotion saved successfully');
    }
    public function update(Request $request, Promotion $promotion)
    {
        // Validate and save the new promotion
        $validatedData = $request->validate([
            'name' => 'required',
            // 'description' => 'required',
            'discount_type' => 'required|string|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'minimum_purchase' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        $promotion->update($validatedData);

        return redirect()->route('promotion.index')->with('success', 'promotion updated successfully');
    }
    public function destroy(Promotion $promotion)
    {
        // Delete the category
        $promotion->delete();
        return redirect()->route('promotion.index')->with('success', 'promotion deleted successfully');
    }
}