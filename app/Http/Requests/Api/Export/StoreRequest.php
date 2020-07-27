<?php

namespace App\Http\Requests\Api\Export;

use App\Http\Requests\Api\BaseRequest;
use App\Services\AutomationService;
use App\Services\Donor\DonorService;
use Illuminate\Validation\Validator;


class StoreRequest extends BaseRequest
{


    public function messages()
    {

        return [
            'book_id.required' => 'The book field is required',
            'object.required' => 'The object field is required',
            'mapping.required' => 'The mapping fields are required',
            'mapping.array' => 'The mapping fields mast be array',
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
            'object' => 'required',
            'book_id' => 'integer',
            'mapping' => 'array|required',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (!in_array($this->input('object'), DonorService::getAllowedObjectKeys())) {
                $validator->errors()->add('event', 'The object field not available');
            }

            $mapping = $this->input('mapping');
            if (empty($mapping['email']) && empty($mapping['phone'])) {
                $validator->errors()->add('mapping', 'The mapping fields must have email OR phone');
            }

            if (!empty($mapping[""])) {
                $validator->errors()->add('mapping', 'Not all mapping fields are valid');
            }
        });
    }

}
