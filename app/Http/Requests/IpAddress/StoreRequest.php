<?php

namespace App\Http\Requests\IpAddress;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ip_address' => 'required|ip|unique:ip_addresses,ip_address'
        ];
    }
}
