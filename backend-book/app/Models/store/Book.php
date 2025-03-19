<?php

namespace App\Models\store;

use App\Models\translation\Booktranslation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Book extends Model
{
    use HasFactory,
        SoftDeletes;

    public $incrementing = false;
    protected $keyType = "string";

    protected $fillable =
    [
        'id',
        'category_id',
        'price',
        'stock',
        'Author'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function order_item()
    {
        return $this->hasMany(Orderitem::class);
    }

    //translation

    public function translations():MorphMany
    {
        return $this->morphMany(Booktranslation::class , 'translatable');
    }

}
