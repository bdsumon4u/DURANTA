<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('notificationRoutes')) {
    function notificationRoutes($group = []) {
        Route::group($group, function () {
            Route::get('/notifications', \App\Http\Controllers\NotificationController::class)->name('notifications');
            Route::post('/notifications/{notification}', [\App\Http\Controllers\NotificationController::class, 'see'])->name('notifications.see');
            Route::patch('/notifications/mark-as-read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read-all');
        });
    }
}
