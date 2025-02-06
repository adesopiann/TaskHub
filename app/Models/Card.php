<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_id',
        'title',
        'description',
        'due_date'
    ];

    public function list(): BelongsTo {
        return $this->belongsTo(ListModel::class);
    }

    public function attachment(): HasMany {
        return $this->hasMany(Attachment::class);
    }
}
