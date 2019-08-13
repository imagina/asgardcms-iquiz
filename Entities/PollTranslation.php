<?php

namespace Modules\Iquiz\Entities;

use Illuminate\Database\Eloquent\Model;

class PollTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'description'
    ];
    protected $table = 'iquiz__poll_translations';
}
