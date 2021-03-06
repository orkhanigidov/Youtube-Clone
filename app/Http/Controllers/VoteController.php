<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Video $video, $type)
    {
        return auth()->user()->toggleVote($video, $type);
    }
}
