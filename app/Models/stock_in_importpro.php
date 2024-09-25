<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_in_importpro extends Model
{
    use HasFactory;
    protected $table="stock_in_importpro";
    protected $fill=['id_stock_in_import'];
}
