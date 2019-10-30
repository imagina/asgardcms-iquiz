<?php

namespace Modules\Iquiz\Events;

use Modules\Iquiz\Entities\UserPoll;

class UserPollWasCreated
{
    public $userPoll;
    public $data;

    public function __construct(UserPoll $userPoll, array $data)
    {
        $this->userPoll = $userPoll;
        $this->data = $data;
    }

}