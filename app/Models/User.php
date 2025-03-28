<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table      = 'Users';
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'FirstName',
        'LastName',
        'Email',
        'PasswordHash',
        'PhoneNumber',
        'IsActive',
        'Address',
    ];

    protected $hidden = [
        'PasswordHash',
        'remember_token',
    ];

    public function getEmailForVerification()
    {
        return $this->Email;
    }

    public function hasVerifiedEmail()
    {
        return ! is_null($this->EmailVerifiedAt);
    }

    public function markEmailAsVerified()
    {
        $this->EmailVerifiedAt = now();
        $this->save();
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailNotification);
    }
    public function Ship()
    {
        return $this->hasMany(Address::class, 'UserID');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'UserID');
    }

    public function city()
    {
        return $this->belongsTo(Provinve::class, 'City');
    }


}
