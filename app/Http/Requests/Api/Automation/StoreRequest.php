<?php

namespace App\Http\Requests\Api\Automation;

use App\Http\Requests\Api\BaseRequest;
use App\Services\AutomationService;
use App\Services\Donor\DonorService;
use Illuminate\Validation\Validator;


class StoreRequest extends BaseRequest
{


    public function messages()
    {

        return [
            'name.required' => 'The name field is required',
            'workflow.required' => 'The workflow field is required',
            'meta.post_url.active_url' => 'The POST URL field mast have valid url',
            'event.required' => 'The event field is required',
            'status.integer' => 'The status field mast be integer',
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
            'name' => 'required',
            'event' => 'required',
            'workflow' => 'bail|required|in:export,post',
            'status' => 'integer',
            'meta' => 'array|required',
            'meta.post_url' => 'active_url|nullable',
            'mapping' => 'array|required',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (!in_array($this->input('event'), DonorService::getAllowedEventKeys())) {
                $validator->errors()->add('event', 'Selected event not available');
            }

            $mapping = $this->input('mapping');
            if ($this->input('workflow') === 'export') {
                if (empty($mapping['email']) && empty($mapping['phone'])) {
                    $validator->errors()->add('mapping', 'The mapping fields must have email OR phone');
                }
            } else {
                $this->request->set('workflow', AutomationService::WORKFLOW_POST);
                if (empty($mapping['email']) || empty($mapping['phone']) || is_array($mapping['email']) || is_array($mapping['phone'])) {
                    $validator->errors()->add('mapping', 'The mapping fields must have email AND phone');
                }
            }

            if (!empty($mapping[""])) {
                $validator->errors()->add('mapping', 'Not all mapping fields are valid');
            }
        });
    }

}
