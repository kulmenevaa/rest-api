<?php

namespace App\Models;

use App\Models\EventTheme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'description',
        'place',
        'location',
        'image',
        'status',
        'date_start',
        'time_start',
        'date_end',
        'time_end',
        'participants',
        'visibility'
    ];

    public function themes() {
        return $this->belongsToMany(EventTheme::class, 'events_by_themes', 'event_id', 'theme_id');
    }
}
