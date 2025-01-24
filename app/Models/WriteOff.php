<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WriteOff extends Model
{
    protected $table = 'supplies';

    protected $fillable = [
        'product_id',
        'title',
        'quantity',
    ];
}
