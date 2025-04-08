<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

/**
 * Контроллер для авторизации пользователей.
 *
 * @package App\Http\Controllers\Api
 */
class AuthController extends Controller
{
    /**
     * Авторизует пользователя и выдает токен.
     *
     * @param AuthRequest $request Валидационный запрос с email и паролем.
     * @return JsonResponse JSON-ответ с токеном и пользователем или сообщением об ошибке.
     */
    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->apiResponse(401, 'error', 'Неверный логин или пароль');
        }

        $user = $request->user();
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->apiResponse(200, 'success', [
            'token' => $token,
            'user' => $user,
        ]);
    }
}
