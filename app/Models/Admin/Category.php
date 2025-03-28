<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
