<?php

use App\Notifications\Seller\SellerWalletUpdated;
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

if (!function_exists('update_seller_wallet')) {
    function update_seller_wallet(\App\Models\Order $order, $product, $changes) {
        $arr = $product->toArray(\request());
        $price = data_get($arr['pivot'], 'price', $arr['price']);
        $discount = data_get($arr['discount'], 'discount', $arr['discount']);
        $commission = data_get($arr['commission'], 'commission', $arr['commission']);
        $amount = ($price - $discount - $commission) * $arr['pivot']['quantity'];
        $message = ' amount ' . $amount . ' for product "' . $arr['name'] . '"x' . $arr['pivot']['quantity'] . ' on changing order #' . $order->id . ' status from "' . $changes['original'] . '" to "' . $changes['present'] . '".';
        $balance = $product->seller->balance;
        if ($changes['present'] === 'DELIVERED') {
            // Increase
            $message = 'Credited' . $message;
            $product->seller->deposit($amount, [
                'message' => $message,
                'balance' => $balance + $amount,
            ]);
        } else {
            // Decrease
            $message = 'Debited' . $message;
            $product->seller->forceWithdraw($amount, [
                'message' => $message,
                'balance' => $balance - $amount,
            ]);
        }
        $product->seller->notify(new SellerWalletUpdated($order, $message));
    }
}
