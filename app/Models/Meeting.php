<?php

namespace App\Models;

use App\Enums\MeetingFormatType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'agenda_id',
        'format_type',
        'chariman_id',
        'secretaty_id',
    ];

    protected $appends = [
        'format_type_label',
    ];

    protected $casts = [
        'format_type' => MeetingFormatType::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    
    public function getFormatTypeLabelAttribute(): string
    {
        return $this->format_type->label();
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function chairman()
    {
        return $this->belongsTo(User::class, 'chariman_id');
    }

    public function secretary()
    {
        return $this->belongsTo(User::class, 'secretaty_id');
    }
}
