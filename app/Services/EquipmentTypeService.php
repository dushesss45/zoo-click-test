<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\EquipmentType;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Сервис для работы с типами оборудования.
 *
 * Предоставляет методы для получения списка типов оборудования с фильтрацией.
 *
 * @package App\Services
 */
class EquipmentTypeService
{
    /**
     * Получить список типов оборудования с возможной фильтрацией по имени.
     *
     * @param array $filters Массив фильтров (например, ['name' => 'маршрутизатор']).
     * @return LengthAwarePaginator Пагинированный список типов оборудования.
     */
    public function all(array $filters = []): LengthAwarePaginator
    {
        $query = EquipmentType::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->paginate(10);
    }
}
