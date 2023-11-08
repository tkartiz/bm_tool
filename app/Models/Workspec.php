<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Workspec extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'size',
        'format',
        'article',
        'content',
        'file',
        'quantity',
        'unit',
    ];    

    public function Workspec2Application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function Workspec2Work(): HasOne
    {
        return $this->hasOne(Work::class, 'work_spec_id', 'id');
    }

}
