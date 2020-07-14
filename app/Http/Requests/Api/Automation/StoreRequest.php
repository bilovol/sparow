<?php

namespace App\Http\Requests\Api\Automation;

use App\Http\Requests\Api\BaseRequest;
use App\Services\AutomationService;
use App\Services\WebhookService;
use Illuminate\Validation\Validator;


class StoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'integer',
            'name' => 'alpha_dash|required|nullable',
            'workflow' => 'bail|required|in:export,post',
            'status' => 'integer',
            'meta' => 'json|required',
            'mapping' => 'json|required',
            'source' => 'required|nullable',
            'rule' => 'json',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $source = $this->input('source');

            if (!in_array($this->input('source'), WebhookService::getAllowedSource())) {
                $validator->errors()->add('source', 'source not avaliable');
            }

            $mapping = json_decode($this->input('mapping'), true);

            if ($this->input('workflow') === 'export') {
                $this->request->set('workflow', AutomationService::WORKFLOW_EXPORT);
                if (empty($mapping['email']) && empty($mapping['phone'])) {
                    $validator->errors()->add('mapping', 'mapping must have email or phone');
                }
            } else {
                $this->request->set('workflow', AutomationService::WORKFLOW_POST);
                if (empty($mapping['email']) || empty($mapping['phone'])) {
                    $validator->errors()->add('mapping', 'mapping must have email and phone');
                }
            }

            $this->request->set('mapping', $mapping);
            $this->request->set('meta', json_decode($this->input('meta'), true));
        });
    }

}
