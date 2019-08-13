<?php

namespace Modules\Iquiz\Entities;

use Illuminate\Database\Eloquent\Model;

class UserPoll extends Model
{
    

    protected $table = 'iquiz__user_polls';
    protected $fillable = [
        'user_id',
        'poll_id'
    ];

    public function user()
    {
      $driver = config('asgard.user.config.driver');
      return $this->belongsTo('Modules\\User\\Entities\\{$driver}\\User');
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }


}
