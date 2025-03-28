<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUsage extends Model
{
    use HasFactory;
    protected $primaryKey = 'UsageID';
    protected $fillable = ['UserID', 'CouponID', 'OrderID'];
}
