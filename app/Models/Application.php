<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject',
        'applicated_at',
        'desired_dlvd_at',
        'works_quantity',
        'severity',
        'ttl_price_incl',
        'ttl_price_exc',
    ];

    public function Application2Workspec(): HasMany
    {
        return $this->hasMany(Workspec::class, 'application_id', 'id');
    }

    public function Application2Contact(): HasMany
    {
        return $this->hasMany(Workspec::class, 'application_id', 'id');
    }

}
