<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StorePhoto extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['photo', 'car_store_id'];

    public function carStore()
    {
        return $this->belongsTo(CarStore::class);
    }
}