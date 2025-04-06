<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_id',
        'question',
        'agreed',
        'against',
        'abstained',
        'attachments',
    ];

    protected $casts = [
        'agreed' => 'array',
        'against' => 'array',
        'abstained' => 'array',
        'attachments' => 'array',
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}
