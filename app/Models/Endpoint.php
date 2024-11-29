<?php

namespace App\Models;

use App\Observers\EndpointObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([EndpointObserver::class])]
class Endpoint extends Model
{


    protected $guarded = ['id'];

    public $dates = [
        'next_check'
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
