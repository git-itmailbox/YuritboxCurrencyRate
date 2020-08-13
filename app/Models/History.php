<?php

namespace App\Models;

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

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
