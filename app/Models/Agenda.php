<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];


    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function meetings()
    {
        return $this->hasOne(Meeting::class);
    }

    public function agendaOptions()
    {
        return $this->hasMany(AgendaOption::class);
    }
}
