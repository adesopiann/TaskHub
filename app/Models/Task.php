<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'due_date'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function attachment(): HasMany {
        return $this->hasMany(Attachment::class);
    }
}
