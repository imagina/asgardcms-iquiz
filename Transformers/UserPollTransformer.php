<?php

namespace Modules\Iquiz\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class UserPollTransformer extends Resource
{
  public function toArray($request)
  {
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'user_id' => $this->when($this->user_id,$this->user_id),
      'poll_id' => $this->when($this->poll_id,$this->poll_id),
      'poll' => new PollTransformer($this->whenLoaded('poll')),
      'createdAt' => $this->when($this->created_at,$this->created_at),
      'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    return $item;
    
  }
}
