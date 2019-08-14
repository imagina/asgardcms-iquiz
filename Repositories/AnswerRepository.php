<?php

namespace Modules\Iquiz\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface AnswerRepository extends BaseRepository
{

    public function getItemsBy($params);
  
    public function getItem($criteria, $params);

    public function updateBy($criteria, $data, $params);

    public function deleteBy($criteria, $params);
    
}
