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
      'answers' => AnswerTransformer::collection($this->whenLoaded('answers')),
      'userQuestionAnswers' => UserQuestionAnswerTransformer::collection($this->whenLoaded('userQuestionAnswers')),
      'createdAt' => $this->when($this->created_at,$this->created_at),
      'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    // TRANSLATIONS
    $filter = json_decode($request->filter);
    // Return data with available translations
    if (isset($filter->allTranslations) && $filter->allTranslations) {
      // Get langs avaliables
      $languages = \LaravelLocalization::getSupportedLocales();
      foreach ($languages as $lang => $value) {
        if ($this->hasTranslation($lang)) {
          $item[$lang]['title'] = $this->hasTranslation($lang) ?
            $this->translate("$lang")['title'] : '';
        }
      }
    }

    // Get Total Votes
    $filter = json_decode($request->filter);
    if (isset($filter->votes)) {
      $totalVotes = 0;
      if(($this->userQuestionAnswers) && count($this->userQuestionAnswers)>0){
        $totalVotes = count($this->userQuestionAnswers);
      }
      $item['totalVotes'] = $totalVotes;
    }

    return $item;
    
  }
}
