<?php

namespace Modules\Iquiz\Repositories\Cache;

use Modules\Iquiz\Repositories\QuestionRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheQuestionDecorator extends BaseCacheDecorator implements QuestionRepository
{
    public function __construct(QuestionRepository $question)
    {
        parent::__construct();
        $this->entityName = 'iquiz.questions';
        $this->repository = $question;
    }
}
