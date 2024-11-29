<?php

namespace App\Models;

use App\Enums\DwellingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dwelling extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'address',
        'price',
        'comments',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'updated_at' => 'datetime:Y-m-d H:i:s',
            'created_at' => 'datetime:Y-m-d H:i:s',
            'status' => DwellingStatus::class,
        ];
    }

    public function transitionStatus(DwellingStatus $newStatus): bool
    {
        if (!$this->status->canTransitionTo($newStatus)) {
            throw new \LogicException("Invalid status transition from {$this->status->name} to {$newStatus->name}");
        }

        return $this->update([
            'status' => $newStatus
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
