<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\EquipmentType;

/**
 * Запрос на создание или обновление оборудования.
 *
 * Используется для валидации данных при сохранении оборудования.
 *
 * @package App\Http\Requests
 */
class EquipmentRequest extends FormRequest
{
    /**
     * Разрешено ли выполнение запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации для создания/обновления оборудования.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');

        return [
            'equipment_type_id' => [$isUpdate ? 'sometimes' : 'required', 'exists:equipment_types,id'],
            'serial_number' => [$isUpdate ? 'sometimes' : 'required', 'string', function ($attribute, $value, $fail) {
                $typeId = $this->input('equipment_type_id') ?? $this->route('equipment')->equipment_type_id ?? null;
                $equipmentType = EquipmentType::find($typeId);

                if (!$equipmentType) {
                    return $fail('Тип оборудования не найден.');
                }

                $pattern = $this->maskToRegex($equipmentType->serial_mask);

                if (!preg_match($pattern, $value)) {
                    return $fail("Серийный номер не соответствует маске: {$equipmentType->serial_mask}");
                }
            }],
            'note' => 'nullable|string',
        ];
    }

    /**
     * Преобразует маску типа оборудования в регулярное выражение.
     *
     * @param string $mask Маска (например, 'AAZNNNX')
     * @return string Регулярное выражение
     */
    private function maskToRegex(string $mask): string
    {
        $map = [
            'N' => '[0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'X' => '[A-Z0-9]',
            'Z' => '[-_@]',
        ];

        $escaped = '';
        foreach (str_split($mask) as $char) {
            $escaped .= $map[$char] ?? preg_quote($char, '/');
        }

        return '/^' . $escaped . '$/';
    }
}
