<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'file_name',
        'file_path',
        'file_type'
    ];

    public function card(): BelongsTo {
        return $this->belongsTo(Card::class);
    }
}
