<?php

namespace Modules\Iquiz\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateAnswerRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
        
        ];
    }

    public function translationRules()
    {
        return [
            'title' => 'required|min:2',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'title.required' => trans('iquiz::common.messages.title is required'),
            'title.min:2'=> trans('iquiz::common.messages.title min 2 '),
            
        ];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('iquiz::common.messages.title is required'),
            'title.min:2'=> trans('iquiz::common.messages.title min 2 '),
            
        ];
    }
}
