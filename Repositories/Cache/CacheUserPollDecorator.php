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

          /**
     * List or resources
     *
     * @return collection
     */
    public function getItemsBy($params)
    {
        return $this->remember(function () use ($params) {
        return $this->repository->getItemsBy($params);
        });
    }
    
    /**
     * find a resource by id or slug
     *
     * @return object
     */
    public function getItem($criteria, $params)
    {
        return $this->remember(function () use ($criteria, $params) {
        return $this->repository->getItem($criteria, $params);
        });
    }

    
}
