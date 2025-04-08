<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ресурс оборудования.
 *
 * Представляет собой форматированное представление сущности Equipment для API-ответа.
 *
 * @package App\Http\Resources
 */
class EquipmentResource extends JsonResource
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
            'equipment_type' => new EquipmentTypeResource($this->whenLoaded('equipmentType')),
            'serial_number' => $this->serial_number,
            'note' => $this->note,
            'created_at' => $this->created_at,
        ];
    }
}
