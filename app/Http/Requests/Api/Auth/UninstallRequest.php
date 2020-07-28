<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseRequest;

class UninstallRequest extends BaseRequest
{


    public function messages()
    {
        return [
            'donor_id.required' => 'The donor_id field is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'donor_id' => 'required',
        ];
    }
}
