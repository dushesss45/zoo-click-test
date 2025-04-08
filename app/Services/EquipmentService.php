<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Equipment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Сервис для работы с оборудованием.
 *
 * Предоставляет методы для получения, создания, обновления и удаления оборудования.
 *
 * @package App\Services
 */
class EquipmentService
{
    /**
     * Получить список оборудования с возможной фильтрацией.
     *
     * @param array $filters Массив фильтров (например, по полям serial_number, note).
     * @return LengthAwarePaginator Пагинированный список оборудования.
     */
    public function all(array $filters = []): LengthAwarePaginator
    {
        $query = Equipment::with('equipmentType');

        foreach (['serial_number', 'note'] as $field) {
            if (!empty($filters[$field])) {
                $query->where($field, 'like', '%' . $filters[$field] . '%');
            }
        }

        return $query->paginate(10);
    }

    /**
     * Найти оборудование по ID.
     *
     * @param int $id Идентификатор оборудования.
     * @return Equipment|null Найденное оборудование или null, если не найдено.
     */
    public function find(int $id): ?Equipment
    {
        return Equipment::with('equipmentType')->find($id);
    }

    /**
     * Создать новое оборудование.
     *
     * @param array $data Данные для создания.
     * @return Equipment Созданное оборудование.
     */
    public function create(array $data): Equipment
    {
        $equipment = Equipment::create($data);
        return $equipment->load('equipmentType');
    }

    /**
     * Обновить оборудование.
     *
     * @param Equipment $equipment Экземпляр оборудования.
     * @param array $data Данные для обновления.
     * @return Equipment Обновлённое оборудование.
     */
    public function update(Equipment $equipment, array $data): Equipment
    {
        $equipment->update($data);
        return $equipment->load('equipmentType');
    }

    /**
     * Удалить оборудование (мягкое удаление).
     *
     * @param Equipment $equipment Экземпляр оборудования.
     * @return void
     */
    public function delete(Equipment $equipment): void
    {
        $equipment->delete();
    }
}
