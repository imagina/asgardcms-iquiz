<?php

namespace Modules\Iquiz\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class QuestionTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'title' => $this->when($this->title,$this->title),
      'multiple' => $this->when($this->multiple,$this->multiple),
      'poll_id' => $this->when($this->poll_id,$this->poll_id),
      'poll' => new PollTransformer($this->whenLoaded('poll')),
      //'answer' => QuestionTransformer::collection($this->whenLoaded('questions')),
      //'userQuestionAnswers' => UserPollTransformer::collection($this->whenLoaded('userPolls')),
      'createdAt' => $this->when($this->created_at,$this->created_at),
      'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    return $item;
    
  }
}
