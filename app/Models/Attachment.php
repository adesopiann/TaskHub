<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    // Daftar atribut yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'task_id',
        'file_name',
        'file_path',
    ];

    // Relasi: Satu attachment dimiliki oleh satu task
    public function task(): BelongsTo {
        return $this->belongsTo(Task::class);
    }
}
