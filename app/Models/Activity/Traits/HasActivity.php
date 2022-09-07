<?php

namespace App\Models\Activity\Traits;

use App\Services\Constant\Activity\ActivityType;
use Illuminate\Support\Str;

trait HasActivity
{
    /**
     * @var string
     */
    protected $activityType = '';

    /**
     * @var string
     */
    protected $activitySubType = '';

    /**
     * @var string
     */
    protected $activityAction = '';

    /**
     * @var array
     */
    protected $activityProperties = [
        'old' => null,
        'new' => null
    ];


    /**
     * @return string
     */
    abstract public function getActivityType(): string;


    public function getActivityProperties()
    {
        return $this->activityProperties;
    }

    public function saveActivity(string|null $description = null)
    {
        $type = ActivityType::GENERAL;
        if (method_exists($this, "getActivityType")) {
            $type = $this->getActivityType();
        }

        return activity()->setType($type)
            ->setSubType($this->activitySubType)
            ->setAction($this->activityAction)
            ->setReference($this)
            ->setProperties($this->activityProperties)
            ->setCreatedAt(now())
            ->log($description);
    }

    public function withActivityProperty(array $property, string|null $key = null)
    {
        if (!$key) {
            $this->activityProperties = array_merge($this->activityProperties, $property);
        } else {
            $this->activityProperties[$key] = $property;
        }

        return $this;
    }

    public function setActivityPropertyAttributes(string $action, string|null $customMethod = null, array|null $others = null)
    {
        $this->activityAction = $action;

        if ($others) {
            $this->withActivityProperty($others, 'others');
        }

        $this->withActivityProperty($this->processGettingAttributes($action, $customMethod), 'new');
        return $this;
    }

    public function setOldActivityPropertyAttributes(string $action, string|null $customMethod = null, array|null $others = null)
    {
        $this->activityAction = $action;

        if ($others) {
            $this->withActivityProperty($others, 'others');
        }

        $this->withActivityProperty($this->processGettingAttributes($action, $customMethod), 'old');
        return $this;
    }


    /** --- FUNCTIONS --- */

    private function processGettingAttributes(string $action, string|null $customMethod = null)
    {
        $method = "getActivityProperty";
        $method .= str_replace("_", "", Str::title($action));

        if ($customMethod) {
            $method .= Str::ucfirst($customMethod);
        }

        return $this->$method();
    }

}
