<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'car_service_id',
        'car_store_id',
        'trx_id',
        'name',
        'phone_number',
        'is_paid',
        'proof',
        'total_amount',
        'started_at',
        'time_at',
    ];

    public static function generateUniqueTrxId()
    {
        $trxId = 'CW' . mt_rand(10000, 99999) . mt_rand(100, 999);
        if (self::where('trx_id', $trxId)->exists()) {
            return self::generateUniqueTrxId();
        }
        return $trxId;
    }


    public function carService()
    {
        return $this->belongsTo(CarService::class);
    }

    public function carStore()
    {
        return $this->belongsTo(CarStore::class);
    }
}
