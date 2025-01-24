<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    public function inventory(): belongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
