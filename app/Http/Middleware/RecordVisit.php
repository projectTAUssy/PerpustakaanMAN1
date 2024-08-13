<?php

// app/Http/Middleware/RecordVisit.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;

class RecordVisit
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == 2) {
            // Check if the user has already visited today
            $today = now()->startOfDay();
            $hasVisitedToday = Visit::where('user_id', Auth::id())
                                    ->whereDate('visited_at', $today)
                                    ->exists();

            if (!$hasVisitedToday) {
                // Record visit
                Visit::create([
                    'user_id' => Auth::id(),
                    'visited_at' => now(),
                ]);
            }
        }

        return $next($request);
    }
}
