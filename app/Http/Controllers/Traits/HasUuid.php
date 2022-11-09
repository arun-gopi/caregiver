<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Support\Str;

trait HasUuid
{

    protected static function bootHasUuid()
    {
        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `uuid` field
         */
        static::creating(function ($model) {
            $columnName = static::getUuidColumn();

            $model->$columnName = Str::uuid()->toString();
        });
    }

    /* Getters and Setters */


    public function getUuidAttribute()
    {
        $columnName = static::getUuidColumn();

        return $this->attributes[$columnName];
    }

    protected static function getUuidColumn()
    {

        return 'uuid';
    }
}
