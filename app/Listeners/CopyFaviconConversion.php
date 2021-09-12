<?php

namespace App\Listeners;

use App\Models\Library;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\Conversions\Events\ConversionHasBeenCompleted;

class CopyFaviconConversion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ConversionHasBeenCompleted $event
     * @return void
     */
    public function handle(ConversionHasBeenCompleted $event)
    {
        $related = $event->media->model()->getRelated();
        if ($related instanceof Library && $event->media->collection_name === 'favicon') {
            $name = $event->media->getGeneratedConversions()->keys()->last();
            File::copy($event->media->getPath($name), public_path('images/icons/icon-'.$name.'.png'));
        }
    }
}
