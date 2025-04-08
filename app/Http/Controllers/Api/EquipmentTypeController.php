<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EquipmentTypeResource;
use App\Services\EquipmentTypeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер для работы с типами оборудования.
 *
 * Предоставляет эндпоинт для получения списка всех типов оборудования.
 *
 * @package App\Http\Controllers\Api
 */
class EquipmentTypeController extends Controller
{
    /**
     * @param EquipmentTypeService $equipmentTypeService Сервис для управления типами оборудования.
     */
    public function __construct(protected EquipmentTypeService $equipmentTypeService) {}

    /**
     * Получить список всех типов оборудования.
     *
     * @param Request $request HTTP-запрос (может содержать фильтры).
     * @return JsonResponse JSON-ответ со списком типов оборудования или ошибкой.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $types = $this->equipmentTypeService->all($request->all());
            return $this->apiResponse(200, 'success', EquipmentTypeResource::collection($types));
        } catch (\Throwable $e) {
            return $this->apiResponse(500, 'error', 'Ошибка получения типов оборудования: ' . $e->getMessage());
        }
    }
}
