<?php

namespace Modules\Iquiz\Entities;

class Status
{
    const DISABLED = 0;
    const ENABLED = 1;
    
    /**
     * @var array
     */
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DISABLED => trans('iquiz::common.status.disabled'),
            self::ENABLED => trans('iquiz::common.status.enabled'),
        ];
    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the event status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::DISABLED];
    }
}
