<?php

namespace App\Observers;

use App\Models\Dwelling;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DwellingObserver
{
    /**
     * Handle the Dwelling "created" event.
     */
    public function created(Dwelling $dwelling): void
    {

    }

    /**
     * Handle the Dwelling "updated" event.
     */
    public function updated(Dwelling $dwelling): void
    {
        if( $dwelling->wasChanged('status') )
        {
            DB::transaction(function () use ($dwelling) {
                $user_id = Auth::id();
                $dwelling_id = $dwelling->id;
                $from = $dwelling->getOriginal('status')->value;
                $to = $dwelling->getChanges()['status'];

                DB::table('logs')
                ->insert([
                    'dwelling_id' => $dwelling_id,
                    'user_id' => $user_id,
                    'from' => $from,
                    'to' => $to,
                    'created_at' => now()
                ]);
            });
        }
    }

    /**
     * Handle the Dwelling "deleted" event.
     */
    public function deleted(Dwelling $dwelling): void
    {
        //
    }

    /**
     * Handle the Dwelling "restored" event.
     */
    public function restored(Dwelling $dwelling): void
    {
        //
    }

    /**
     * Handle the Dwelling "force deleted" event.
     */
    public function forceDeleted(Dwelling $dwelling): void
    {
        //
    }
}
