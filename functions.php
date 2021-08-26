<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('notificationRoutes')) {
    function notificationRoutes($group = []) {
        Route::group($group, function () {
            Route::get('/notifications', \App\Http\Controllers\NotificationController::class)->name('notifications');
            Route::post('/notifications/{notification}', [\App\Http\Controllers\NotificationController::class, 'see'])->name('notifications.see');
            Route::patch('/notifications/mark-as-read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read-all');
        });
    }
}

if (!function_exists('is_localhost')) {
    function is_localhost(): bool {
        return in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1', '::1']);
    }
}

if (!function_exists('cdn')) {
    function cdn($path, $secure = null): string {
        if (is_localhost()) {
            return asset($path, $secure);
        }

        $host = parse_url(config('app.url'), PHP_URL_HOST);
        return 'https://cdn.statically.io/img/' .$host. Str::after($path, $host);
    }
}
