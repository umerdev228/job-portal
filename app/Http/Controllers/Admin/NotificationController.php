<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;


class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        Notification::where('status', 'unread')->update(['status' => 'read']);
        return redirect()->back();
    }

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return Inertia::render('Admin/Notification/Show', [
            'notification' => $notification,
        ]);
    }
}
