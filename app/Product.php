<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\ProductCategory;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'photo', 'name', 'selling_price',
        'purchase_price', 'stock', 'category'
    ];

    protected $hidden = [];

    // Relasi
    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }
}
