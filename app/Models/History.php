<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    const FIELD_CURRENCY_ID = 'currency_id';
    const FIELD_VALUE = 'value';
    const FIELD_DATE = 'date';
    const FIELD_NOMINAL = 'nominal';

    const FACTOR = 10000;

    protected $fillable = [
        self::FIELD_CURRENCY_ID,
        self::FIELD_VALUE,
        self::FIELD_DATE,
        self::FIELD_NOMINAL,
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopeDateBetween(Builder $query, $dateFrom, $dateTo): Builder
    {
        return $query->where('date', '>=', (string) $dateFrom)
            ->where('date', '<=', (string) $dateTo);
    }
}
