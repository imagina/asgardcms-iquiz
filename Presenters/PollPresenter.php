<?php

namespace Modules\Iquiz\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Iquiz\Entities\Status;

class PollPresenter extends Presenter
{
  
    protected $status;
   
    public function __construct($entity){

        parent::__construct($entity);
        $this->status = app('Modules\Iquiz\Entities\Status');
    }

    public function status(){
        return $this->status->get($this->entity->status);
    }

    public function statusLabelClass(){
        switch ($this->entity->status){

            case Status::DISABLED:
                return 'bg-red';
                break;

            case Status::ENABLED:
                return 'bg-green';
                break;

            default:
                return 'bg-red';
                break;

        }
    }


}
