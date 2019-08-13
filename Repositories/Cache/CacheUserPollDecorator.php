<?php

namespace Modules\Iquiz\Repositories\Cache;

use Modules\Iquiz\Repositories\UserPollRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheUserPollDecorator extends BaseCacheDecorator implements UserPollRepository
{
    public function __construct(UserPollRepository $userpoll)
    {
        parent::__construct();
        $this->entityName = 'iquiz.userpolls';
        $this->repository = $userpoll;
    }
}
