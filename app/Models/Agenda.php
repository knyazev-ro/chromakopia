<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
