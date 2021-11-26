<?php

namespace App\Models;

use App\Traits\UUIDs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory, UUIDs;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
    ];

    public function votable()
    {
        return $this->morphTo();
    }
}
