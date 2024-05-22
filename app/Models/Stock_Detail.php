<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_Detail extends Model
{
    use HasFactory;

    protected $table = "stock_details";

    protected $fillable = [
        'book_id',
        'uni_code',
        'quantity',
        'price',
        'status',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }
}
