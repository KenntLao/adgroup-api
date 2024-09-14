<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'event',
        'model_type',
        'model_id',
        'changes',
        'user_id',
    ];

    protected $casts = [
        'changes' => 'array',
    ];
}
