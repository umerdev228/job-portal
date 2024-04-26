<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_feature', true)
            ->where('status', Category::STATUS_ACTIVE)
            ->limit(4)
            ->get();

        // Updated query to fetch only approved jobs
        if (request()->method() == 'POST' && $request->category_id > 0) {
            $jobs = Job::where('is_feature', true)
                ->where('category_id', $request->category_id)
                ->where('status', 'approved')
                ->latest()
                ->take(8)
                ->get();
        } else {
            $jobs = Job::where('is_feature', true)
                ->where('status', 'approved')
                ->latest()
                ->take(8)
                ->get();
        }

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'categories' => $categories,
            'jobs' => $jobs,
            'category_id' => $request->category_id ?? 0,
        ]);
    }
}
