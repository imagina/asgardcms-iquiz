<?php

namespace Modules\Iquiz\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class AnswerTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'title' => $this->when($this->title,$this->title),
      'question_id' => $this->when($this->question_id,$this->question_id),
      'question' => new QuestionTransformer($this->whenLoaded('question')),
      'userQuestionAnswers' => UserQuestionAnswerTransformer::collection($this->whenLoaded('userQuestionAnswers')),
      'createdAt' => $this->when($this->created_at,$this->created_at),
      'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];
  
    // Get Votes
    $filter = json_decode($request->filter);
    if (isset($filter->votes)) {
      $votes = 0;
      if(($this->userQuestionAnswers) && count($this->userQuestionAnswers)>0)
        $votes = count($this->userQuestionAnswers);

      $item['votes'] = $votes;
    }

    return $item;
    
  }
}
