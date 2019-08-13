<?php

namespace Modules\Iquiz\Repositories\Cache;

use Modules\Iquiz\Repositories\AnswerRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAnswerDecorator extends BaseCacheDecorator implements AnswerRepository
{
    public function __construct(AnswerRepository $answer)
    {
        parent::__construct();
        $this->entityName = 'iquiz.answers';
        $this->repository = $answer;
    }
}
