<?php

namespace App\Presentation\Requests\Auth;

use App\Domain\User\User\User;
use App\Presentation\Requests\FormRequest;

/**
 * Class RegisterRequest
 * @package App\Presentation\Requests\Auth
 */
final class RegisterRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::COLUMN_NAME => 'required|string',
            User::COLUMN_EMAIL => 'required|email|unique:users,email',
            User::COLUMN_PASSWORD => 'required|confirmed|between:8,32',
            'password_confirmation' => 'required|between:8,32'
        ];
    }
}
