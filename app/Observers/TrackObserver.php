<?php

namespace App\Observers;

use App\Models\Track;
use App\Models\Category;

class TrackObserver
{
    /**
     * Handle the Track "created" event.
     *
     * @param  \App\Models\Track  $track
     * @return void
     */
    public function created(Track $track)
    {
        $category = $track->category;
        $category->increment('tracks_count');
    }

    /**
     * Handle the Track "deleted" event.
     *
     * @param  \App\Models\Track  $track
     * @return void
     */
    public function deleted(Track $track)
    {
        $category = $track->category;
        $category->decrement('tracks_count');
    }
}
