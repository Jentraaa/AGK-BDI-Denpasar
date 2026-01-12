<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Mengganti 'name' dan 'email' menjadi 'username'
            'username' => [
                'required',
                'string',
                'alpha_dash', // Memastikan username hanya berisi huruf, angka, dash, dan underscore
                'max:255',
                // Memastikan username unik, tapi mengabaikan ID user yang sedang login agar bisa di-save
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Custom error messages (Opsional)
     */
    public function messages(): array
    {
        return [
            'username.unique' => 'Username ini sudah digunakan oleh staf lain.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda hubung (-), dan garis bawah (_).',
        ];
    }
}