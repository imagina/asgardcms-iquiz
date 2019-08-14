<?php

namespace Modules\Iquiz\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateUserPollRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'poll_id' => 'required',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'poll_id.required' => trans('iquiz::common.messages.field required'),
        ];
    }

    public function translationMessages()
    {
        return [
            'poll_id.required' => trans('iquiz::common.messages.field required'),
        ];
    }
}
