<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POSModel extends Model
{
    use HasFactory;

    // Define the table name (since Laravel defaults to plural table names)
    protected $table = 'pos';

    // Allow mass assignment for specific fields
    protected $fillable = ['po_name', 'grand_total', 'customer_name', 'created_at', 'order_id'];

    // Optionally disable timestamps if not needed (since only created_at exists)
    public $timestamps = false;
}
