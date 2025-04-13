<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;


    // Daftar atribut yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'due_date'
    ];

    // Relasi: Task dimiliki oleh satu user
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // Relasi: Task memiliki banyak attachment
    public function attachments(): HasMany {
        return $this->hasMany(Attachment::class, 'task_id');
    }
}
