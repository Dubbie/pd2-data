<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableEntry extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = "key";

    protected $fillable = [
        'key',
        'value'
    ];
}
