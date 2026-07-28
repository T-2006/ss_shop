<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromotionNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_id',
        'user_id',
        'canal',
        'enviado_at',
    ];

    protected function casts(): array
    {
        return [
            'enviado_at' => 'datetime',
        ];
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
