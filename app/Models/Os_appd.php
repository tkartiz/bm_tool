<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Os_appd extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'comment',
        'spec',
        'order_recipient',
        'price_incl',
        'price_exc',
        'price_list',
        'comp_num',
        'remarks',
        'appd1_id',
        'appd1_approval',
        'appd1_comment',
        'appd1_appd_at',
        'appd2_id',
        'appd2_approval',
        'appd2_comment',
        'appd2_appd_at',
    ];

    public function Os_appd2Work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }

    public function Os_appd2Outsourcing(): HasOne
    {
        return $this->hasOne(Outsourcing::class, 'os_appd_id', 'id');
    }
}
