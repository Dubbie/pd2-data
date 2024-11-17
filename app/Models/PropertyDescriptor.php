<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDescriptor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'param',
        'min',
        'max',
        'property_code',
        'describable_id',
        'describable_type'
    ];

    public function describable()
    {
        return $this->morphTo();
    }
}
