<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Services\EquipmentService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер управления оборудованием.
 *
 * Отвечает за CRUD-операции: получение списка, просмотр, создание, обновление и удаление оборудования.
 *
 * @package App\Http\Controllers\Api
 */
class EquipmentController extends Controller
{
    /**
     * @param EquipmentService $equipmentService Сервис работы с оборудованием.
     */
    public function __construct(protected EquipmentService $equipmentService) {}

    /**
     * Получить список оборудования.
     *
     * @param Request $request HTTP-запрос с возможной фильтрацией.
     * @return JsonResponse JSON-ответ с коллекцией оборудования.
     */
    public function index(Request $request): JsonResponse
    {
        $equipments = $this->equipmentService->all($request->all());
        return $this->apiResponse(200, 'success', EquipmentResource::collection($equipments));
    }

    /**
     * Получить информацию об одном оборудовании по ID.
     *
     * @param int $id Идентификатор оборудования.
     * @return JsonResponse JSON-ответ с данными об оборудовании или ошибкой.
     */
    public function show(int $id): JsonResponse
    {
        $equipment = $this->equipmentService->find($id);

        if (!$equipment) {
            return $this->apiResponse(404, 'error', 'Оборудование не найдено');
        }

        return $this->apiResponse(200, 'success', new EquipmentResource($equipment));
    }

    /**
     * Создать новое оборудование.
     *
     * @param EquipmentRequest $request Валидационные данные запроса.
     * @return JsonResponse JSON-ответ с созданным оборудованием.
     */
    public function store(EquipmentRequest $request): JsonResponse
    {
        $equipment = $this->equipmentService->create($request->validated());
        return $this->apiResponse(201, 'success', new EquipmentResource($equipment));
    }

    /**
     * Обновить существующее оборудование.
     *
     * @param EquipmentRequest $request Валидационные данные.
     * @param Equipment $equipment Модель оборудования, которую нужно обновить.
     * @return JsonResponse JSON-ответ с обновлёнными данными.
     */
    public function update(EquipmentRequest $request, Equipment $equipment): JsonResponse
    {
        $equipment = $this->equipmentService->update($equipment, $request->validated());
        return $this->apiResponse(200, 'success', new EquipmentResource($equipment));
    }

    /**
     * Удалить оборудование.
     *
     * @param Equipment $equipment Модель оборудования.
     * @return JsonResponse JSON-ответ об успешном или неуспешном удалении.
     */
    public function destroy(Equipment $equipment): JsonResponse
    {
        try {
            $this->equipmentService->delete($equipment);
            return $this->apiResponse(200, 'success', 'Оборудование успешно удалено');
        } catch (\Throwable $e) {
            return $this->apiResponse(500, 'error', 'Ошибка удаления: ' . $e->getMessage());
        }
    }
}
