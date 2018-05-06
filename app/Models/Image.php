<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['uuid'];

    public static function boot()
    {
        parent::boot();

        static::creating(function($image) {
            $image->uuid = Uuid::uuid4()->toString();
        });
    }
}