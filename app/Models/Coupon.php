<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons'; // Specify the table name if it's different from the model name.
    protected $fillable = [
        'coupon_code',
        'discount_percentage',
        'expiration_date',
        'usage_limit',
    ];
    public $timestamps = false; // Set this to false to disable timestamps
}