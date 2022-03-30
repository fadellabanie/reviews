<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renter extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasManyThrough(
            Review::class,
            Booking::class,
            'renter_id',
            'booking_id',
            'id',
            'id'
        );
    }
}
