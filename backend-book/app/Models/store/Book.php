<?php

namespace App\Models\store;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory,
        SoftDeletes;

    public $incrementing = false;
    protected $keyType = "string";

    protected $fillabel =
    [
        'id',
        'category_id',
        'price',
        'stock'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
