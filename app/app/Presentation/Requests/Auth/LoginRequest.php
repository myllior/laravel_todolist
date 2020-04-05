<?php

namespace App\Presentation\Requests\Auth;

use App\Domain\User\User\User;
use App\Presentation\Requests\FormRequest;

/**
 * Class LoginRequest
 * @package App\Presentation\Requests\Auth
 */
final class LoginRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::COLUMN_EMAIL => 'required|email',
            User::COLUMN_PASSWORD => 'required|between:8,32'
        ];
    }
}
