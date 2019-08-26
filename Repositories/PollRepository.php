<?php

namespace Modules\Iquiz\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PollRepository extends BaseRepository
{

    public function getItemsBy($params);
  
    public function getItem($criteria, $params);

    
}
