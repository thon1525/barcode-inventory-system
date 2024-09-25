<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
   protected $fillable = [
    'name',
    'discount_type',
    'discount_value',
    'minimum_purchase',
    'start_date',
    'end_date',
];
	

}
