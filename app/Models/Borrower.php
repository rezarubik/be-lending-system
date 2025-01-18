<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Borrower extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'phone', 'dob', 'ktp_number', 'ktp_photo', 'monthly_income', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function calculateLoanLimit()
    {
        return $this->monthly_income * 0.3; // 30% dari penghasilan bulanan
    }
}
