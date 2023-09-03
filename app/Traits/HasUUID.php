<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;


trait HasUUID
{
    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }


    // Tells Eloquent Model not to auto-increment this field
    public function getIncrementing()
    {
        return false;
    }

    // Tells that the IDs on the table should be stored as strings
    public function getKeyType()
    {
        return 'string';
    }
}
