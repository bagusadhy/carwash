<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'car_service_id',
        'car_store_id',
    ];

    public function carService()
    {
        return $this->belongsTo(CarService::class);
    }

    public function carStore()
    {
        return $this->belongsTo(CarStore::class);
    }
}
