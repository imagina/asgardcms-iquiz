<?php

namespace Modules\Iquiz\Repositories\Cache;

use Modules\Iquiz\Repositories\UserQuestionAnswerRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheUserQuestionAnswerDecorator extends BaseCacheDecorator implements UserQuestionAnswerRepository
{
    public function __construct(UserQuestionAnswerRepository $userquestionanswer)
    {
        parent::__construct();
        $this->entityName = 'iquiz.userquestionanswers';
        $this->repository = $userquestionanswer;
    }
}
