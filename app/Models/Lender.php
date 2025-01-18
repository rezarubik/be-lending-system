<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Lender extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'phone', 'dob', 'ktp_number', 'ktp_photo', 'npwp', 'monthly_income', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi dengan investasi
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
