<?php

namespace App\Traits;

trait InteractsWithInertiaBanner
{
    /**
     * Update the banner message.
     *
     * @param  string  $message
     * @return \Illuminate\Http\Response
     */
    protected function banner($message)
    {
        return redirect()->back()->banner($message);
    }

    /**
     * Update the banner message with an danger / error message.
     *
     * @param  string  $message
     * @return \Illuminate\Http\Response
     */
    protected function dangerBanner($message)
    {
        return redirect()->back()->dangerBanner($message);
    }
}
