<?php

namespace App\Http\Requests\IpAddress;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'label' => 'required|string|max:255'
        ];
    }
}
