<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsTo(Category::class);
    }

    public function subcategories(){
        return $this->belongsTo(Subcategory::class);
    }

}
