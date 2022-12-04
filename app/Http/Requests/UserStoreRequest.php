<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;

class UserStoreRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "login"=>['required', 'string', 'max:255', Rule::unique(User::class, 'login')],
            "nickname"=>["required","string"],
            "password"=>["required","string"],
        ];
    }
}
