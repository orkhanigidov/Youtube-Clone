<?php

namespace App\Models;

use App\Traits\UUIDs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, UUIDs;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'path',
        'thumbnail',
        'percentage',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function editable()
    {
        return auth()->check() && $this->channel->user_id === auth()->user()->id;
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}
