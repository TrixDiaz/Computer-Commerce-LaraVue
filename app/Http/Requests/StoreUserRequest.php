<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|lowercase|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'email_verified_at' => 'nullable|date',
            'password' => ['required'],
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'role_id' => 'nullable|exists:'.User::class.',id',
            'deleted_at' => 'nullable|date',
            'remember_token' => 'nullable|string|max:100',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ];
    }
}
