<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventTheme extends Model
{
    use HasFactory;

    protected $table = 'event_themes';

    protected $fillable = [
        'name'
    ];

    public function events() {
        return $this->belongsToMany(Event::class, 'events_by_themes', 'theme_id', 'event_id');
    }
}
