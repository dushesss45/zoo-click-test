<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ресурс типа оборудования.
 *
 * Представляет собой форматированное представление сущности EquipmentType для API-ответа.
 *
 * @package App\Http\Resources
 */
class EquipmentTypeResource extends JsonResource
{
    /**
     * Преобразует ресурс в массив для JSON-ответа.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'serial_mask' => $this->serial_mask,
        ];
    }
}
