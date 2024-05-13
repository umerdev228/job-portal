<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return Inertia::render('Admin/Dashboard', [
            'notifications' => $notifications,
            // Other data you want to pass to the view
        ]);
    }
}
