<?php

namespace App\Models\translation;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BookTranslation extends Model
{
    use HasFactory , SoftDeletes;

    public $incrementing = false;
    protected $keyType='string';
    protected $table = 'book_translations'; // ✅ Explicitly setting the correct table name

    protected $fillable=
    [
        
        'translatable_id',
        'translatable_type',
        'language_code',
        'name',
        'desc',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
            $model->id = (string) Str::uuid();
        });
    }


    public function translatable():MorphTo
    {
        return $this->morphTo();
    }
}
