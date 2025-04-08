<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * Класс запроса для авторизации пользователя.
 *
 * Используется для валидации данных при попытке входа.
 *
 * @package App\Http\Requests
 */
class AuthRequest extends FormRequest
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
     * Правила валидации для авторизации.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
}
