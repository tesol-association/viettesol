<?php

namespace App\Observers;

use App\Models\Conference;
use Illuminate\Support\Facades\Redis;

class ConferenceObserver
{
    /**
     * Handle the conference "created" event.
     *
     * @param  \App\Conference  $conference
     * @return void
     */
    public function created(Conference $conference)
    {
        Redis::set('conference:' . $conference->id, serialize($conference));
    }

    /**
     * Handle the conference "updated" event.
     *
     * @param  \App\Conference  $conference
     * @return void
     */
    public function updated(Conference $conference)
    {
        Redis::set('conference:' . $conference->id, serialize($conference));
    }

    /**
     * Handle the conference "deleted" event.
     *
     * @param  \App\Conference  $conference
     * @return void
     */
    public function deleted(Conference $conference)
    {

    }
}
