<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'count' => $request->user()->notifications()->count(),
                'unread' => $request->user()->unreadNotifications()->count(),
                'latest' => NotificationResource::collection($request->user()->notifications()->latest()->take(3)->get()),
            ]);
        }

        return Inertia::render('Notifications', [
            'notifications' => NotificationResource::collection($request->user()->notifications()->latest()->paginate(10)),
        ]);
    }

    public function see(Request $request, $notification) {
        $notification = $request->user()->notifications()->findOrFail($notification);
        $link = data_get($notification->data, 'link', back()->getTargetUrl());
        $notification->markAsRead();
        return redirect($link);
    }

    public function markAsRead(Request $request)
    {
        $request->user()->notifications->markAsRead();
        return back();
    }
}
