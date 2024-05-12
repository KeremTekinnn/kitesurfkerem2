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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'address' => ['nullable', 'string', 'max:255'],
            'residence' => ['nullable', 'string', 'max:255'],
            'birthdate' => ['nullable', 'date'],
            'mobile' => ['nullable', 'string', 'max:10'],
        ];

        if ($this->user()->hasRole('instructor') || $this->user()->hasRole('admin')) {
            $rules['bsn_number'] = ['nullable', 'string', 'max:9'];
        }

        return $rules;
    }
}
