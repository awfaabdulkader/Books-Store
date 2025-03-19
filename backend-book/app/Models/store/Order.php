<?php

namespace App\Models\store;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory , SoftDeletes;

    public $incrementing=false;
    protected $keyType = "string";

    protected $fillable =
    [
        'id',
        'user_id',
        'total_price',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function  ($model)
        {
            $model->id = (string) Str::uuid();
        });
    }


    public function users()
    {
        return $this->belongsTo(Order::class);
    }

    public function order_items()
    {
        return $this->hasMany(Orderitem::class);
    }
}
