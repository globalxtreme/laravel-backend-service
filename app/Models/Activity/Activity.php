<?php

namespace App\Models\Activity;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends BaseModel
{
    protected $table = 'activities';
    protected $guarded = ['id'];

    protected $dates = [self::CREATED_AT, self::UPDATED_AT, self::DELETED_AT];


    /** RELATIONSHIPS */

    public function referable(): MorphTo
    {
        return $this->morphTo('referable', 'referenceType', 'reference');
    }


    /** --- SCOPES --- */

    public function scopeFilter($query, $request)
    {
        return $query->where(function ($query) use ($request) {

            if ($request->type != '') {
                $query->where('type', $request->type);
            }

            if ($request->action != '') {
                $query->where('action', $request->action);
            }

            if ($this->hasSearch($request)) {
                $query->where(function ($query) use ($request) {
                    $query->where('description', 'LIKE', "%$request->search%")
                        ->orWhere('causedByName', 'LIKE', "%$request->search%");
                });
            }

        });
    }

}
