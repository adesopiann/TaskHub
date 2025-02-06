<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'board_id',
        'name',
        'position'
    ];

    public function board(): BelongsTo {
        return $this->belongsTo(Board::class);
    }

    public function card(): HasMany {
        return $this->hasMany(Card::class);
    }
}
