<?php

use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withSchedule(function(Schedule $schedule) {

        $schedule->call(function(){
            $today = now();
            //start_date ve end_dateyi gün ile karşılaştırarak is_visibleyi ayarlıyorum.
        Post::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->update(['is_visible' => 1]);

        Post::where('end_date', '<', $today)
            ->orWhere('start_date', '>', $today)
            ->update(['is_visible' => 0]);

        })->daily();

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
