<?php

namespace App\Models\store;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class payement extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';




    public static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
            $model->id=(string) Str::uuid();
        });
    }
}
