<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_spec_id',
        'creator_id',
        'outsourcing',
        'os_appd_id',
        'started_at',
        'completed_at',
        'price_incl',
        'price_exc',
        'message',
    ];

    public function Work2Workspec(): BelongsTo
    {
        return $this->belongsTo(Workspec::class);
    }

    public function Work2Os_appd(): HasOne
    {
        return $this->hasOne(Os_appd::class, 'work_id', 'id');
    }

}
