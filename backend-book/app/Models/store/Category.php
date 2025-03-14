<?php

namespace App\Models\store;

use App\Models\translation\BookTranslation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = "string";


    protected $fillable = ['id'];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
            
        });
    }


    public function books()
    {
        return $this->hasMany(Book::class);
    }


 // In Category model
public function translations(): MorphMany
{
    return $this->morphMany(BookTranslation::class, 'translatable');
}


}
