<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    use HasFactory;

    protected $table = ' sale_details';
    protected $fillable = [
        'book_id',
        'sales_id',
        'uni_code',
        'customer_id',
        'quantity',
        'price',
        'subtotal',
        'user_id',
        'status',
    ];
}
