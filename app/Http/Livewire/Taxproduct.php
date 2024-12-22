<?php

namespace App\Http\Livewire;

use App\Models\Category; // Import Eloquent Model for categories
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Taxproduct extends Component
{
    public $tax; // To store the tax name
    public $taxprice; // To store the tax percentage
    public $can_check = false; // Checkbox state
    public $category = []; // Array to hold categories
    public $category_selected; // To store selected category ID (catid)

    // Validation rules
    protected $rules = [
        'tax' => 'required|min:2|max:20',
        'taxprice' => 'required|numeric|min:0|max:100',
        'category_selected' => 'nullable|exists:categories,catid', // Validate category existence
    ];

    // Mount function to load categories on component initialization
    public function mount()
    {
        // Load categories and convert to an array
        $this->category =  $this->category = DB::table('categories')
        ->select('catid', 'category_name')
        ->get()
        ->toArray();
    }

    // Save function to handle form submission
    public function save()
    {
        // Validate user input
        $this->validate();

        try {
            // Insert tax product into database
            DB::table('taxproduct')->insert([
                'nametax' => $this->tax,
                'price_tax' => $this->taxprice / 100,
                'tax_cardid' => $this->category_selected, // Selected catid
            ]);

            // Set success message and redirect
            session()->flash('success', 'Tax product saved successfully!');
            return redirect('/view/manage/tax');
        } catch (\Exception $e) {
            // Log error and set error message
            Log::error('Error saving tax product:', ['error' => $e->getMessage()]);
            session()->flash('error', 'Something went wrong while saving the tax product.');
        }
    }

    // Render function to return the Blade view
    public function render()
    {
        return view('livewire.taxproduct');
    }
}
