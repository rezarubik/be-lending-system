<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id', 'lender_id', 'amount', 'bank', 'va_number',
    // ];
    protected $guarded = [];

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }
}
