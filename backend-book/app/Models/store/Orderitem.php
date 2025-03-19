<?php

namespace App\Models\store;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orderitem extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'order_items'; // Add this line

    protected $fillable = 
    [
        'id',
        'order_id',
        'book_id',
        'quantity',
        'price',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
            $model->id = (string) Str::uuid();
        });
    }


    public function orders()
    {
        return $this->belongsTo(Order::class);
    }

    public function books()
    {
        return $this->belongsTo(Book::class);
    }
}
