<?php

namespace App\Models\Component\Traits;

use App\Models\Activity\Traits\HasActivity;
use App\Services\Constant\Activity\ActivityType;
use App\Services\Parser\Component\ComponentParser;

trait HasActivityComponentProperty
{
    use HasActivity;

    protected $activitySubType = 'media_origin';


    /**
     * @return string
     */
    public function getActivityType(): string
    {
        return ActivityType::COMPONENT;
    }


    /**
     * @return array
     */
    public function getActivityPropertyCreate()
    {
        return $this->setActivityPropertyParser();
    }

    /**
     * @return array
     */
    public function getActivityPropertyUpdate()
    {
        return $this->setActivityPropertyParser();
    }

    /**
     * @return array
     */
    public function getActivityPropertyDelete()
    {
        return $this->setActivityPropertyParser() + [
                'deletedAt' => $this->deletedAt?->format('d/m/Y H:i')
            ];
    }


    /** --- FUNCTIONS --- */

    /**
     * @return array|null
     */
    private function setActivityPropertyParser()
    {
        $this->refresh();

        return ComponentParser::first($this);
    }

}
