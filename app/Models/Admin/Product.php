<?php

namespace App\Models\Admin;

use App\Models\AttrPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,
            'brand_id','id');
    }

    public function tax(){
        return $this->belongsTo(Tax::class,
            'tax_id','id');
    }

}
