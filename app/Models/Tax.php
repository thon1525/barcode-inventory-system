<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $table = 'taxproduct';
    protected $fillable = ['id_tex','nametax', 'price_tax'];
    public $timestamps = false; // Set this to false to disable timestamps

}
