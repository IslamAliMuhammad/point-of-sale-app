<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['category_id', 'image', 'purchase_price', 'sale_price', 'stock'];
    public $appends = ['image_path', 'profit_percent'];


    public function getImagePathAttribute() {
       return asset('uploads/product-images/' . $this->image);
    }

    public function getProfitPercentAttribute() {
        $profit = $this->sale_price - $this->purchase_price;
        $profiPercent = $profit * 100 / $this->purchase_price;
        return number_format($profiPercent, 2);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
