<?php

// app/Http/Middleware/LoadNotifications.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationsController;

class LoadNotifications
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $notificationsController = new NotificationsController();
            $notifications = $notificationsController->getUserNotifications(null);
            $newMessageNotifications = $notifications->where('type', \App\Model\Notification::NEW_MESSAGE);
            $unreadMessageCount = $newMessageNotifications->where('read', false)->count();
            view()->share('notifications', $notifications);
            view()->share('unreadMessageCount', $unreadMessageCount);
        }

        return $next($request);
    }
}
