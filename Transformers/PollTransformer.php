<?php

namespace Modules\Iquiz\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class PollTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'title' => $this->when($this->title,$this->title),
      'description' => $this->when($this->description,$this->description),
      'startDate' => $this->when($this->start_date,$this->start_date),
      'endDate' => $this->when($this->end_date,$this->end_date),
      'logged' => $this->when($this->logged,$this->logged),
      'status' => $this->when($this->status,$this->status),
      'statusName' => $this->when($this->present()->status,$this->present()->status),
      //'questions' => QuestionTransformer::collection($this->whenLoaded('questions')),
      //'userPolls' => UserPollTransformer::collection($this->whenLoaded('userPolls')),
      'createdAt' => $this->when($this->created_at,$this->created_at),
      'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    return $item;
    
  }
}
