<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Модель "Тип оборудования".
 *
 * Представляет тип оборудования с маской серийного номера.
 *
 * @property int $id
 * @property string $name
 * @property string $serial_mask
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class EquipmentType extends Model
{
    /**
     * Массово присваиваемые атрибуты.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'serial_mask'];

    /**
     * Связь "один ко многим" с оборудованием.
     *
     * @return HasMany
     */
    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }
}
