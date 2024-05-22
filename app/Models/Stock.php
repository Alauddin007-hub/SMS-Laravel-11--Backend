<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

     protected $table = "stocks";

    protected $fillable = [
        'book_id',
        'stock_detail_id',
        'total_quantity',
        'total_price',
        'status',
    ];

    // public function updateOrCreate(array $attributes, array $values = []);

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function stock_detail(){
        return $this->belongsTo(Stock_Detail::class);
    }
}
