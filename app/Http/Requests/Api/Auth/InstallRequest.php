<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseRequest;

class InstallRequest extends BaseRequest
{


    public function messages()
    {
        return [
            'donor_id.required' => 'The donor_id field is required',
            'access_token.required' => 'The access_token field is required',
            'refresh_token.required' => 'The refresh_token field is required',
            'member_id.required' => 'The member_id field is required',
            'domain.required' => 'The domain field is required',
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
            'access_token' => 'required',
            'refresh_token' => 'required',
            'member_id' => 'required',
            'domain' => 'required',
        ];
    }
}
