<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Модель "Оборудование".
 *
 * Представляет запись об экземпляре оборудования с привязкой к типу.
 *
 * @property int $id
 * @property int $equipment_type_id
 * @property string $serial_number
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 */
class Equipment extends Model
{
    use SoftDeletes;

    /**
     * Массово присваиваемые атрибуты.
     *
     * @var array<int, string>
     */
    protected $fillable = ['equipment_type_id', 'serial_number', 'note'];

    /**
     * Связь с типом оборудования (EquipmentType).
     *
     * @return BelongsTo
     */
    public function equipmentType(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
