<?php

namespace App\Models\Common;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'original_name',
        'type',
        'section',
        'module',
        'size',
        'options',
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleted(function ($item) {
            Storage::delete($item->path);
        });

        static::creating(function ($item) {
            $item->user_id = Auth::user()->id;
            $item->author = Auth::user()->full_name;
        });

    }
}
