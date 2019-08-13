<?php

namespace Modules\Iquiz\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use Translatable;

    protected $table = 'iquiz__answers';
    public $translatedAttributes = [
        'title'
    ];
    protected $fillable = [
        'question_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function userQuestionAnswers()
    {
        return $this->hasMany(UserQuestionAnswer::class);
    }

}
