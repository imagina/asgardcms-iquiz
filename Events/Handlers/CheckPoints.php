<?php

namespace Modules\Iquiz\Events\Handlers;


class CheckPoints
{
   
    private $setting;
    private $pointRepository;

    public function __construct()
    {
        $this->setting = app('Modules\Setting\Contracts\Setting');
        $this->pointRepository =  app('Modules\Iredeems\Repositories\PointRepository');
    }

    public function handle($event)
    {

        $userPoll = $event->userPoll;
        $data = $event->data;

        // Just users loggin
        if(isset($userPoll->user_id) && !empty($userPoll->user_id)){
           
            // Settings Iredeems
            $checkPoll =  $this->setting->get('iredeems::points-per-finished-poll-checkbox');

            // Points Actives
            if($checkPoll){
                $pointsPoll = $this->setting->get('iredeems::points-per-finished-poll');
                if((int)$pointsPoll>0){
                   
                    $class=\Modules\Iquiz\Entities\Poll::class;
                    $data = array(
                        "user_id"=> (int)$userPoll->user_id,
                        "pointable_id" => (int)$userPoll->poll_id,
                        "pointable_type" => $class,
                        "type" => "poll-completed",
                        "points" => (int)$pointsPoll,
                        "description" => trans("iredeems::common.settingsMsg.points-per-poll")
                    );

                    $this->pointRepository->create($data);

                }

            }

        }

      

    }// If handle

}