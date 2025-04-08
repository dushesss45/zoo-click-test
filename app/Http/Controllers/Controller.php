<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Форматирует унифицированный API-ответ.
     *
     * @param int $statusCode Код состояния HTTP
     * @param string $status Статус ответа ("success" или "error")
     * @param mixed|null $data Данные или сообщение
     * @return JsonResponse
     */
    protected function apiResponse(int $statusCode, string $status, mixed $data = null): JsonResponse
    {
        $response = [
            'status' => $status,
            'data' => $status === 'success' ? $data : null,
            'message' => $status === 'error' ? $data : null,
        ];

        return response()->json($response, $statusCode);
    }
}
