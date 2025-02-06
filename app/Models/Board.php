<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function list(): hasMany {
        return $this->hasMany(ListModel::class);
    }
}
