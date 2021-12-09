<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
