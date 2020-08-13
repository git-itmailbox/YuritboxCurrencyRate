<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    const FIELD_NUMCODE = 'numcode';
    const FIELD_CHARCODE = 'charcode';
    const FIELD_NAME = 'name';
    const FIELD_DESCRIPTION = 'description';

    protected $fillable = [
        self::FIELD_NUMCODE,
        self::FIELD_CHARCODE,
        self::FIELD_NAME,
        self::FIELD_DESCRIPTION,
    ];

    public function histories()
    {
        $this->hasMany(History::class);
    }
}
