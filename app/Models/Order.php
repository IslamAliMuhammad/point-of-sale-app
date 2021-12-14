<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'total_price'];

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot(['quantity']);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
