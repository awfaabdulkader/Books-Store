<?php

namespace App\Models\store;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Review extends Model
{
    use HasFactory , SoftDeletes;

    public $incrementing = false;
    protected $keyType='string';

    protected $fillable=
    [
        "id",
        'user_id',
        'book_id',
        'rating',
        'comment',
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
