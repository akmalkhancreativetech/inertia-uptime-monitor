<?php

namespace App\Models;

use App\Observers\SiteObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy([SiteObserver::class])]
class Site extends Model
{
    protected $guarded = ['id'];

    public function url(): string
    {
        return $this->scheme . '://' . $this->domain;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function endpoints(): HasMany
    {
        return $this->hasMany(Endpoint::class)
            ->latest();
    }
}
