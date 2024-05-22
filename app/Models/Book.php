<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_bangla_name',
        'book_english_name',
        'category_id',
        'writer_id',
        'short_description',
        'image',
        'publising_date',
        'book_of_page',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function writer(){
        return $this->belongsTo(Writer::class);
    }

    public function stock_detail()
    {
        return $this->hasMany(Stock_Detail::class, 'book_id');
    }
}
