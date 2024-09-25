<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Rule;
use Livewire\Component;


class Taxproduct extends Component
{
    public $tax;
    public $taxprice;

    protected $rules = [
        'nametax' => 'required|min:6',
        'price_tax' => 'required|min:6',
    ];
    public function save()
    {
        $this->validate([
            'tax' => 'required|min:2',
            'taxprice' => 'required|min:1',
        ]);

      DB::table('taxproduct')->select('nametax','price_tax')->insert([
        'nametax'=>$this->tax,
        'price_tax'=>$this->taxprice/100,
      ]);
      return redirect('/view/manage/tax');
    }
    public function render()
    {
        return view('livewire.taxproduct');
    }
}
