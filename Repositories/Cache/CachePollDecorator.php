<?php

namespace Modules\Iquiz\Repositories\Cache;

use Modules\Iquiz\Repositories\PollRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePollDecorator extends BaseCacheDecorator implements PollRepository
{
    public function __construct(PollRepository $poll)
    {
        parent::__construct();
        $this->entityName = 'iquiz.polls';
        $this->repository = $poll;
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
