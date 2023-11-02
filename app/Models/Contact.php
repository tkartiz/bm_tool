<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_id',
        'email',
        'title',
        'message',
    ];

    public function Contact2Application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
