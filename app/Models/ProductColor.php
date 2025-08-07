<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    //
    protected $guarded = [];
    protected $table = 'product_colors';
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
