<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
   

    public function markAllAsRead()
{

    // Update all unread notifications to read
    Notification::where('status', 'unread')->update(['status' => 'read']);
    
    return redirect()->back(); // Redirect back to the previous page after marking notifications as read
}
    
}
