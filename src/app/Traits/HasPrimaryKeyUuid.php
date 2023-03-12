<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasPrimaryKeyUuid
{
    public static function bootHasPrimaryKeyUuid(): void
    {
        static::creating(static function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * @return bool
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}
