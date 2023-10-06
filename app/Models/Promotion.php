<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Promotion extends Model
{
    protected $fillable = [
        'user_id',
        'product_service_name',
        'target_audience',
        'description',
        'start_date',
        'end_date',
        'discount_amount',
        
    ];

    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
}


