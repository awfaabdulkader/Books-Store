<?php

namespace App\Models\store;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory , SoftDeletes;

    public $incrementing = false;
    protected $keyType='string';
    protected $table = 'wishlist';

    protected $fillable=
    [
        'id',
        'user_id',
        'book_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
            $model->id = (string) Str::uuid();
        });
    }



    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->belongsTo(Book::class);

    }
}
