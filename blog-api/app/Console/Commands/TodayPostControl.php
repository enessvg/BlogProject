<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class TodayPostControl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:today-post-control';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $today = now();
            //start_date ve end_dateyi gün ile karşılaştırarak is_visibleyi ayarlıyorum.
        Post::where('start_date', '<=', $today)
        ->where('end_date', '>=', $today)
        ->update(['is_visible' => 1]);

        Post::where('end_date', '<', $today)
        ->orWhere('start_date', '>', $today)
        ->update(['is_visible' => 0]);


    }
}
