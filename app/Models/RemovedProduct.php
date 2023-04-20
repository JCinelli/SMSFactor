<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class RemovedProduct extends Model
{
    use HasFactory;

    protected $fillable = ['product_id'];

    public function products()
    {

        return $this->hasMany(Product::class);
    }
}
