<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Outsourcing extends Model
{
    use HasFactory;

    protected $fillable = [
        'os_appd_id',
        'comp_name',
        'comp_price_incl',
        'comp_price_exc',
        'comp_remarks',
        'comp_file1',
        'comp_file1path',
        'comp_file2',
        'comp_file2path',
        'comp_file3',
        'comp_file3path',
    ];

    public function Outsourcing2Os_appd(): BelongsTo
    {
        return $this->belongsTo(Os_appd::class);
    }
}
