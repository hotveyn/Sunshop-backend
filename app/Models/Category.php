<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categoryParent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }
    public function categoryChildren(): HasMany
    {
        return $this->HasMany(static::class, 'parent_id');
    }
}
