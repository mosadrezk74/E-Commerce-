<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table='coupons';
    protected $primaryKey = 'CouponID';
    protected $fillable = [
        'Code', 'DiscountType', 'DiscountValue',
        'ValidFrom', 'ValidTo', 'UsageLimit',
        'UsedCount', 'MinOrderAmount', 'IsActive'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_usages')
                    ->withPivot('OrderID');
    }

    public function isValid()
    {
        return $this->IsActive && now()->between($this->ValidFrom, $this->ValidTo)
         && $this->UsedCount < $this->MaxUsage;
    }


    use HasFactory;
}
